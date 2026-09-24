<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreReviewRequest;
use App\Models\RatingUlasan;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function create(Transaksi $transaksi): View
    {
        $this->ensureOwned($transaksi);
        abort_unless($transaksi->canBeReviewed(), 404);

        return view('customer.review-create', compact('transaksi'));
    }

    public function store(StoreReviewRequest $request, Transaksi $transaksi): RedirectResponse
    {
        $this->ensureOwned($transaksi);
        abort_unless($transaksi->canBeReviewed(), 404);

        DB::transaction(function () use ($request, $transaksi): void {
            RatingUlasan::create([
                'transaksi_id' => $transaksi->id,
                'user_id' => $transaksi->user_id,
                'bintang' => $request->integer('bintang'),
                'ulasan' => $request->input('ulasan'),
            ]);

            $transaksi->user()->increment('poin', $request->integer('bintang') * 20);
        });

        return redirect()->route('customer.orders.show', $transaksi)
            ->with('success', 'Terima kasih! Ulasan Anda telah disimpan.');
    }

    private function ensureOwned(Transaksi $transaction): void
    {
        $user = Auth::guard('web')->user();

        abort_unless($transaction->user_id === $user->id, 404);
    }
}
