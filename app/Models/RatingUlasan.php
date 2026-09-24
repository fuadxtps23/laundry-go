<?php

namespace App\Models;

use Database\Factories\RatingUlasanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingUlasan extends Model
{
    /** @use HasFactory<RatingUlasanFactory> */
    use HasFactory;

    protected $table = 'rating_ulasan';

    protected $fillable = [
        'transaksi_id',
        'user_id',
        'bintang',
        'ulasan',
    ];

    protected function casts(): array
    {
        return [
            'bintang' => 'integer',
        ];
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function transaksi(): BelongsTo
    {
        return $this->transaction();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
