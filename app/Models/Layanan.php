<?php

namespace App\Models;

use Database\Factories\LayananFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layanan extends Model
{
    /** @use HasFactory<LayananFactory> */
    use HasFactory;

    protected $table = 'layanan';

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga_per_kg',
        'satuan',
        'estimasi_hari',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'harga_per_kg' => 'decimal:2',
            'estimasi_hari' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    public function transaksi(): HasMany
    {
        return $this->transactions();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
