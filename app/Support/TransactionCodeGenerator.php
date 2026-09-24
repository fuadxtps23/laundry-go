<?php

namespace App\Support;

use App\Models\TransactionSequence;
use Illuminate\Support\Facades\DB;

class TransactionCodeGenerator
{
    public function generate(): string
    {
        return DB::transaction(function (): string {
            $sequence = TransactionSequence::query()
                ->lockForUpdate()
                ->findOrFail(1);

            $number = $sequence->last_number + 1;
            $sequence->update(['last_number' => $number]);

            return 'LG-'.str_pad((string) $number, 4, '0', STR_PAD_LEFT);
        });
    }
}
