<?php

namespace App\Http\Controllers\Staff;

use App\Enums\LaundryStatus;
use App\Enums\PaymentStatus;
use App\Http\Requests\Staff\ReportRequest;
use App\Models\Karyawan;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends StaffController
{
    public function index(ReportRequest $request): View
    {
        [$from, $to, $period] = $this->dateRange($request);
        $transactions = $this->query($request, $from, $to)
            ->with(['user', 'layanan', 'karyawan'])
            ->latest('tanggal_masuk')
            ->latest('id')
            ->get();
        $paidTransactions = $transactions->where('status_pembayaran', PaymentStatus::Lunas);
        $revenue = (float) $paidTransactions->sum('total_harga');
        $employeeRecap = $this->employeeRecap($from, $to);

        return $this->staffView('staff.reports.index', compact(
            'transactions',
            'paidTransactions',
            'revenue',
            'employeeRecap',
            'from',
            'to',
            'period',
        ));
    }

    public function export(ReportRequest $request): Response
    {
        [$from, $to, $period] = $this->dateRange($request);
        $transactions = $this->query($request, $from, $to)
            ->with(['user', 'layanan', 'karyawan'])
            ->latest('tanggal_masuk')
            ->latest('id')
            ->get();

        if ($request->input('format') === 'csv') {
            return response()->streamDownload(function () use ($transactions): void {
                $handle = fopen('php://output', 'wb');
                fputcsv($handle, ['Kode', 'Tanggal', 'Pelanggan', 'Layanan', 'Total', 'Status Laundry', 'Status Pembayaran']);
                foreach ($transactions as $transaction) {
                    fputcsv($handle, [
                        $transaction->kode_transaksi,
                        $transaction->tanggal_masuk->format('Y-m-d'),
                        $transaction->user->nama_lengkap,
                        $transaction->layanan->nama_layanan,
                        $transaction->total_harga,
                        $transaction->status_laundry->value,
                        $transaction->status_pembayaran->value,
                    ]);
                }
                fclose($handle);
            }, "laporan-laundry-{$from->format('Ymd')}-{$to->format('Ymd')}.csv", ['Content-Type' => 'text/csv']);
        }

        $pdf = Pdf::loadView('reports.print', [
            'transactions' => $transactions,
            'employeeRecap' => $this->employeeRecap($from, $to),
            'revenue' => (float) $transactions->where('status_pembayaran', PaymentStatus::Lunas)->sum('total_harga'),
            'from' => $from,
            'to' => $to,
            'period' => $period,
            'role' => $this->role(),
            'staffUser' => $this->currentUser(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download("laporan-laundry-{$from->format('Ymd')}-{$to->format('Ymd')}.pdf");
    }

    /** @return Collection<int, array{employee: Karyawan, count: int, revenue: float}> */
    private function employeeRecap(Carbon $from, Carbon $to): Collection
    {
        return Karyawan::query()
            ->withCount(['transactions as transaction_count' => fn (Builder $query) => $query->whereBetween('tanggal_masuk', [$from, $to])])
            ->withSum(['transactions as revenue' => fn (Builder $query) => $query
                ->whereBetween('tanggal_masuk', [$from, $to])
                ->where('status_pembayaran', PaymentStatus::Lunas->value)], 'total_harga')
            ->get()
            ->map(fn (Karyawan $employee): array => [
                'employee' => $employee,
                'count' => (int) $employee->transaction_count,
                'revenue' => (float) $employee->revenue,
            ]);
    }

    private function query(ReportRequest $request, Carbon $from, Carbon $to): Builder
    {
        return Transaksi::query()
            ->whereBetween('tanggal_masuk', [$from, $to])
            ->when(in_array($request->input('status'), LaundryStatus::values(), true), fn (Builder $query) => $query->where('status_laundry', $request->input('status')));
    }

    /** @return array{Carbon, Carbon, string} */
    private function dateRange(ReportRequest $request): array
    {
        $period = in_array($request->input('period'), ['harian', 'mingguan', 'bulanan'], true)
            ? $request->input('period')
            : 'harian';
        $to = $request->date('to') ?: Carbon::today();
        $from = $request->date('from') ?: match ($period) {
            'mingguan' => $to->copy()->subDays(6),
            'bulanan' => $to->copy()->startOfMonth(),
            default => $to->copy(),
        };

        if ($from->gt($to)) {
            [$from, $to] = [$to, $from];
        }

        return [$from->startOfDay(), $to->endOfDay(), $period];
    }
}
