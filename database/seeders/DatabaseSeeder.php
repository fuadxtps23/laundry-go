<?php

namespace Database\Seeders;

use App\Models\TransactionSequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        (new AdminSeeder)->run();
        (new LayananSeeder)->run();

        TransactionSequence::query()->firstOrCreate(
            ['id' => 1],
            ['last_number' => 0],
        );
    }
}
