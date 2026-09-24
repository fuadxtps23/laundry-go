<?php

namespace App\Http\Controllers\Staff;

use App\Enums\LaundryStatus;
use App\Enums\PaymentStatus;
use App\Models\Karyawan;
use App\Models\RatingUlasan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends StaffController
{
    public function __invoke(): View
    {
        $today = Carbon::today();
        $revenueToday = (float) Transaksi::query()
            ->where('status_pembayaran', PaymentStatus::Lunas->value)
            ->whereHas('payment', fn ($query) => $query->whereDate('tanggal_bayar', $today))
            ->sum('total_harga');
        $averageRating = (float) RatingUlasan::query()->avg('bintang');
        $recentTransactions = Transaksi::query()
            ->with(['user', 'layanan', 'karyawan'])
            ->latest('created_at')
            ->latest('id')
            ->limit(8)
            ->get();

        $stats = [
            'allTransactions' => Transaksi::count(),
            'todayTransactions' => Transaksi::whereDate('tanggal_masuk', $today)->count(),
            'waiting' => Transaksi::where('status_laundry', LaundryStatus::Menunggu->value)->count(),
            'processing' => Transaksi::where('status_laundry', LaundryStatus::Diproses->value)->count(),
            'completed' => Transaksi::whereIn('status_laundry', [LaundryStatus::Selesai->value, LaundryStatus::Diambil->value])->count(),
            'customers' => User::count(),
            'employees' => Karyawan::count(),
            'revenue' => (float) Transaksi::where('status_pembayaran', PaymentStatus::Lunas->value)->sum('total_harga'),
            'revenueToday' => $revenueToday,
            'averageRating' => $averageRating,
        ];

        return $this->staffView('staff.dashboard.index', compact('stats', 'recentTransactions'));
    }
}
