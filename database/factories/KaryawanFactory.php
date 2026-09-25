<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/** @extends Factory<Karyawan> */
class KaryawanFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => '08'.fake()->unique()->numerify('##########'),
            'posisi_jabatan' => fake()->randomElement(Karyawan::POSITIONS),
            'password' => static::$password ??= Hash::make('password'),
            'role' => Karyawan::ROLE_KARYAWAN,
            'remember_token' => Str::random(10),
        ];
    }
}
