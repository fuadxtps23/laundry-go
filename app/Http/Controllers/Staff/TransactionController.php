<?php

namespace App\Http\Controllers\Staff;

use App\Enums\LaundryStatus;
use App\Http\Requests\Staff\AssignTransactionRequest;
use App\Http\Requests\Staff\UpdateTransactionRequest;
use App\Http\Requests\Staff\UpdateTransactionStatusRequest;
use App\Models\Karyawan;
use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionController extends StaffController
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));
        $status = $request->input('status');
        $paymentStatus = $request->input('payment_status');

        $transactions = Transaksi::query()
            ->with(['user', 'layanan', 'karyawan'])
            ->when($search, function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('kode_transaksi', 'like', "%{$search}%")
                        ->orWhereHas('user', fn (Builder $userQuery) => $userQuery
                            ->where('nama_lengkap', 'like', "%{$search}%")
                            ->orWhere('no_hp', 'like', "%{$search}%"));
                });
            })
            ->when(in_array($status, LaundryStatus::values(), true), fn (Builder $query) => $query->where('status_laundry', $status))
            ->when(in_array($paymentStatus, ['belum_dibayar', 'menunggu_verifikasi', 'lunas'], true), fn (Builder $query) => $query->where('status_pembayaran', $paymentStatus))
            ->latest('created_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return $this->staffView('staff.transactions.index', [
            'transactions' => $transactions,
            'search' => $search,
            'status' => $status,
            'paymentStatus' => $paymentStatus,
        ]);
    }

    public function show(Transaksi $transaksi): View
    {
        return $this->staffView('staff.transactions.show', [
            'transaction' => $transaksi->load(['user', 'layanan', 'karyawan', 'payment', 'review']),
            'employees' => Karyawan::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function edit(Transaksi $transaksi): View
    {
        return $this->staffView('staff.transactions.edit', [
            'transaction' => $transaksi,
            'services' => Layanan::orderBy('nama_layanan')->get(),
            'employees' => Karyawan::orderBy('nama_lengkap')->get(),
        ]);
    }

    public function update(UpdateTransactionRequest $request, Transaksi $transaksi): RedirectResponse
    {
        $service = Layanan::findOrFail($request->integer('layanan_id'));
        $weight = round((float) $request->input('berat'), 2);

        DB::transaction(function () use ($request, $transaksi, $service, $weight): void {
            $transaksi->update([
                'layanan_id' => $service->id,
                'berat' => $weight,
                'total_harga' => round($weight * (float) $service->harga_per_kg, 2),
                'tanggal_masuk' => $request->date('tanggal_masuk'),
                'tanggal_estimasi_selesai' => $request->date('tanggal_estimasi_selesai'),
                'catatan' => $request->input('catatan'),
                'karyawan_id' => $this->role() === 'admin'
                    ? $request->input('karyawan_id')
                    : $transaksi->karyawan_id,
            ]);
        });

        return back()->with('success', 'Data transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi): RedirectResponse
    {
        $transaksi->delete();

        return redirect()->route($this->role().'.transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }

    public function updateStatus(UpdateTransactionStatusRequest $request, Transaksi $transaksi): RedirectResponse
    {
        $status = LaundryStatus::from($request->string('status_laundry')->toString());

        if (! $transaksi->canTransitionTo($status)) {
            return back()->with('error', 'Status laundry hanya dapat maju: menunggu → diproses → selesai → diambil.');
        }

        $transaksi->transitionTo($status);

        return back()->with('success', 'Status laundry berhasil diperbarui.');
    }

    public function assign(AssignTransactionRequest $request, Transaksi $transaksi): RedirectResponse
    {
        abort_unless($this->role() === 'admin', 403);
        $transaksi->update(['karyawan_id' => $request->integer('karyawan_id')]);

        return back()->with('success', 'Karyawan berhasil ditugaskan.');
    }
}
