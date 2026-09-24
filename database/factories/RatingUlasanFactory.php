<?php

namespace Database\Factories;

use App\Enums\LaundryStatus;
use App\Models\RatingUlasan;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<RatingUlasan> */
class RatingUlasanFactory extends Factory
{
    public function definition(): array
    {
        $transaction = Transaksi::factory()->status(LaundryStatus::Selesai)->create();

        return [
            'transaksi_id' => $transaction->id,
            'user_id' => $transaction->user_id,
            'bintang' => fake()->numberBetween(1, 5),
            'ulasan' => fake()->sentence(),
        ];
    }
}
