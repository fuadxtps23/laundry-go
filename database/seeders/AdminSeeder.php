<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama_lengkap' => 'Administrator Laundry Go',
                'email' => 'admin@laundrygo.com',
                'no_hp' => '081234567890',
                'password' => 'admin123',
            ],
        );
    }
}
