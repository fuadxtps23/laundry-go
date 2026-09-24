<?php

namespace App\Http\Controllers\Customer;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StorePaymentRequest;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function show(Transaksi $transaksi): View
    {
        $this->ensureOwned($transaksi);

        return view('customer.payment', [
            'transaction' => $transaksi->load('payment'),
            'methods' => PaymentMethod::cases(),
        ]);
    }

    public function store(StorePaymentRequest $request, Transaksi $transaksi): RedirectResponse
    {
        $this->ensureOwned($transaksi);

        if ($transaksi->status_pembayaran === PaymentStatus::Lunas) {
            return back()->with('error', 'Pembayaran transaksi ini sudah lunas.');
        }

        $proofPath = $transaksi->payment?->bukti_pembayaran;
        if ($request->hasFile('bukti_pembayaran')) {
            $proofPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        DB::transaction(function () use ($request, $transaksi, $proofPath): void {
            Pembayaran::updateOrCreate(
                ['transaksi_id' => $transaksi->id],
                [
                    'metode' => $request->input('metode'),
                    'jumlah_bayar' => $request->input('jumlah_bayar'),
                    'bukti_pembayaran' => $proofPath,
                    'tanggal_bayar' => now(),
                    'status' => PaymentStatus::MenungguVerifikasi,
                ],
            );

            $transaksi->update(['status_pembayaran' => PaymentStatus::MenungguVerifikasi]);
        });

        return redirect()->route('customer.orders.show', $transaksi)
            ->with('success', 'Pembayaran berhasil dikirim dan menunggu verifikasi.');
    }

    private function ensureOwned(Transaksi $transaction): void
    {
        $user = Auth::guard('web')->user();

        abort_unless($transaction->user_id === $user->id, 404);
    }
}
