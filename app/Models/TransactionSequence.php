<?php

namespace App\Models;

use Database\Factories\TransactionSequenceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionSequence extends Model
{
    /** @use HasFactory<TransactionSequenceFactory> */
    use HasFactory;

    protected $table = 'transaction_sequences';

    protected $fillable = ['id', 'last_number'];

    protected function casts(): array
    {
        return ['last_number' => 'integer'];
    }
}
