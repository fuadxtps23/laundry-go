<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreOrderRequest;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Support\TransactionCodeGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View
    {
        return view('customer.order-create', [
            'layanan' => Layanan::active()->orderBy('nama_layanan')->get(),
        ]);
    }

    public function store(StoreOrderRequest $request, TransactionCodeGenerator $codeGenerator): RedirectResponse
    {
        $user = Auth::guard('web')->user();
        $layanan = Layanan::active()->findOrFail($request->integer('layanan_id'));
        $tanggalMasuk = $request->date('tanggal_masuk');
        $berat = round((float) $request->input('berat'), 2);
        $totalHarga = round($berat * (float) $layanan->harga_per_kg, 2);

        $transaction = DB::transaction(function () use ($request, $user, $layanan, $tanggalMasuk, $berat, $totalHarga, $codeGenerator): Transaksi {
            return Transaksi::create([
                'kode_transaksi' => $codeGenerator->generate(),
                'user_id' => $user->id,
                'layanan_id' => $layanan->id,
                'berat' => $berat,
                'total_harga' => $totalHarga,
                'tanggal_masuk' => $tanggalMasuk,
                'tanggal_estimasi_selesai' => $tanggalMasuk->copy()->addDays($layanan->estimasi_hari),
                'catatan' => $request->input('catatan'),
            ]);
        });

        return redirect()->route('customer.orders.show', $transaction)
            ->with('success', 'Pesanan laundry berhasil dibuat dengan kode '.$transaction->kode_transaksi.'.');
    }

    public function index(Request $request): View
    {
        $user = Auth::guard('web')->user();
        $transactions = $user->transactions()
            ->with(['layanan', 'payment', 'review'])
            ->latest('created_at')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('customer.orders', compact('transactions'));
    }

    public function show(Transaksi $transaksi): View
    {
        $this->ensureOwned($transaksi);

        return view('customer.order-show', [
            'transaction' => $transaksi->load(['layanan', 'karyawan', 'payment', 'review']),
        ]);
    }

    private function ensureOwned(Transaksi $transaction): void
    {
        $user = Auth::guard('web')->user();

        abort_unless($transaction->user_id === $user->id, 404);
    }
}
