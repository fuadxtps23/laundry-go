<?php

namespace Database\Factories;

use App\Models\TransactionSequence;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<TransactionSequence> */
class TransactionSequenceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'last_number' => 0,
        ];
    }
}
