<?php

namespace Database\Factories;

use App\Enums\LaundryStatus;
use App\Enums\PaymentStatus;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Transaksi> */
class TransaksiFactory extends Factory
{
    public function definition(): array
    {
        $layanan = Layanan::factory()->create();
        $berat = fake()->randomFloat(2, 1, 10);
        $tanggalMasuk = fake()->dateTimeBetween('-10 days', 'now');

        return [
            'kode_transaksi' => 'LG-'.fake()->unique()->numerify('####'),
            'user_id' => User::factory(),
            'layanan_id' => $layanan->id,
            'berat' => $berat,
            'total_harga' => $berat * (float) $layanan->harga_per_kg,
            'tanggal_masuk' => $tanggalMasuk,
            'tanggal_estimasi_selesai' => (clone $tanggalMasuk)->modify('+'.$layanan->estimasi_hari.' days'),
            'catatan' => fake()->optional()->sentence(),
            'status_laundry' => LaundryStatus::Menunggu,
            'status_pembayaran' => PaymentStatus::BelumDibayar,
            'karyawan_id' => null,
        ];
    }

    public function status(LaundryStatus $status): static
    {
        return $this->state(fn (array $attributes): array => ['status_laundry' => $status]);
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status_pembayaran' => PaymentStatus::Lunas,
        ]);
    }
}
