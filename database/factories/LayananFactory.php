<?php

namespace Database\Factories;

use App\Models\Layanan;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Layanan> */
class LayananFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_layanan' => fake()->unique()->words(2, true),
            'deskripsi' => fake()->sentence(),
            'harga_per_kg' => fake()->numberBetween(9000, 50000),
            'satuan' => fake()->randomElement(['kg', 'pasang', 'potong', 'm2']),
            'estimasi_hari' => fake()->numberBetween(1, 3),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes): array => ['is_active' => false]);
    }
}
