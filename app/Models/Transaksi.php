<?php

namespace App\Models;

use App\Enums\LaundryStatus;
use App\Enums\PaymentStatus;
use Database\Factories\TransaksiFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use InvalidArgumentException;

class Transaksi extends Model
{
    /** @use HasFactory<TransaksiFactory> */
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'layanan_id',
        'karyawan_id',
        'berat',
        'total_harga',
        'tanggal_masuk',
        'tanggal_estimasi_selesai',
        'catatan',
        'status_laundry',
        'status_pembayaran',
    ];

    protected $attributes = [
        'status_laundry' => LaundryStatus::Menunggu->value,
        'status_pembayaran' => PaymentStatus::BelumDibayar->value,
    ];

    protected function casts(): array
    {
        return [
            'berat' => 'decimal:2',
            'total_harga' => 'decimal:2',
            'tanggal_masuk' => 'date',
            'tanggal_estimasi_selesai' => 'date',
            'status_laundry' => LaundryStatus::class,
            'status_pembayaran' => PaymentStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function pembayaran(): HasOne
    {
        return $this->payment();
    }

    public function review(): HasOne
    {
        return $this->hasOne(RatingUlasan::class);
    }

    public function ratingUlasan(): HasOne
    {
        return $this->review();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereIn('status_laundry', [LaundryStatus::Menunggu->value, LaundryStatus::Diproses->value]);
    }

    public function scopeForCustomer(Builder $query, User $user): Builder
    {
        return $query->whereBelongsTo($user);
    }

    public function canTransitionTo(LaundryStatus $status): bool
    {
        return $this->status_laundry->next() === $status;
    }

    public function transitionTo(LaundryStatus $status): void
    {
        if (! $this->canTransitionTo($status)) {
            throw new InvalidArgumentException('Status laundry hanya dapat maju satu tahap.');
        }

        $this->status_laundry = $status;
        $this->save();
    }

    public function isFinished(): bool
    {
        return in_array($this->status_laundry, [LaundryStatus::Selesai, LaundryStatus::Diambil], true);
    }

    public function canBeReviewed(): bool
    {
        if (! $this->isFinished()) {
            return false;
        }

        return $this->relationLoaded('review')
            ? $this->getRelation('review') === null
            : ! $this->review()->exists();
    }
}
