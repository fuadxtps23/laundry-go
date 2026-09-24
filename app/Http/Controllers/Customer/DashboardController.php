<?php

namespace App\Http\Controllers\Customer;

use App\Enums\LaundryStatus;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::guard('web')->user();
        $transactions = $user->transactions()
            ->with(['layanan', 'payment', 'review'])
            ->latest('created_at')
            ->latest('id')
            ->get();

        $activeCount = $transactions->whereIn('status_laundry', [LaundryStatus::Menunggu, LaundryStatus::Diproses])->count();
        $completedCount = $transactions->whereIn('status_laundry', [LaundryStatus::Selesai, LaundryStatus::Diambil])->count();
        $paidTotal = (int) $transactions->where('status_pembayaran', PaymentStatus::Lunas)->sum('total_harga');
        $latestTransaction = $transactions->first();
        $latestPayment = $transactions->firstWhere(fn (Transaksi $transaction): bool => $transaction->payment !== null);
        $latestReview = $transactions->firstWhere(fn (Transaksi $transaction): bool => $transaction->review !== null);

        return view('customer.dashboard', compact(
            'user',
            'transactions',
            'activeCount',
            'completedCount',
            'paidTotal',
            'latestTransaction',
            'latestPayment',
            'latestReview',
        ));
    }
}
