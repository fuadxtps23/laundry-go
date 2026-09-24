<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/** @extends Factory<User> */
class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => '08'.fake()->unique()->numerify('##########'),
            'alamat' => fake()->address(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => User::ROLE_PELANGGAN,
            'poin' => fake()->numberBetween(0, 500),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    public function customer(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => User::ROLE_PELANGGAN,
        ]);
    }
}
