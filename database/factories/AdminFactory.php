<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/** @extends Factory<Admin> */
class AdminFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => '08'.fake()->unique()->numerify('##########'),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
