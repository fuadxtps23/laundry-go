<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Pembayaran> */
class PembayaranFactory extends Factory
{
    public function definition(): array
    {
        $transaction = Transaksi::factory()->create();

        return [
            'transaksi_id' => $transaction->id,
            'metode' => PaymentMethod::Qris,
            'jumlah_bayar' => $transaction->total_harga,
            'bukti_pembayaran' => 'bukti_pembayaran/demo.png',
            'tanggal_bayar' => now(),
            'status' => PaymentStatus::MenungguVerifikasi,
        ];
    }
}
