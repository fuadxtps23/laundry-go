<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_PELANGGAN = 'pelanggan';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'no_hp',
        'alamat',
        'password',
        'role',
        'poin',
    ];

    protected $attributes = [
        'role' => self::ROLE_PELANGGAN,
        'poin' => 0,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'poin' => 'integer',
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

    public function reviews(): HasMany
    {
        return $this->hasMany(RatingUlasan::class);
    }

    public function ratingUlasan(): HasMany
    {
        return $this->reviews();
    }

    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_PELANGGAN;
    }

    public function activeTransactions(): HasMany
    {
        return $this->transactions()->whereIn('status_laundry', ['menunggu', 'diproses']);
    }

    public function paidTransactionTotal(): int
    {
        return (int) $this->transactions()
            ->where('status_pembayaran', PaymentStatus::Lunas->value)
            ->sum('total_harga');
    }
}
