<?php

namespace App\Http\Controllers\Staff;

use App\Enums\PaymentStatus;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PaymentController extends StaffController
{
    public function index(Request $request): View
    {
        $status = $request->input('status');
        $search = trim((string) $request->input('search'));
        $payments = Pembayaran::query()
            ->with(['transaction.user', 'transaction.layanan'])
            ->when(in_array($status, PaymentStatus::values(), true), fn (Builder $query) => $query->where('status', $status))
            ->when($search, function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->whereHas('transaction', fn (Builder $transactionQuery) => $transactionQuery
                        ->where('kode_transaksi', 'like', "%{$search}%")
                        ->orWhereHas('user', fn (Builder $userQuery) => $userQuery->where('nama_lengkap', 'like', "%{$search}%")));
                });
            })
            ->latest('created_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        return $this->staffView('staff.payments.index', compact('payments', 'status', 'search'));
    }

    public function verify(Pembayaran $pembayaran): RedirectResponse
    {
        if ($pembayaran->status !== PaymentStatus::MenungguVerifikasi) {
            return back()->with('error', 'Pembayaran hanya dapat diverifikasi saat menunggu verifikasi.');
        }

        DB::transaction(function () use ($pembayaran): void {
            $pembayaran->verify();
        });

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }
}
