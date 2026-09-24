<?php

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Database\Factories\PembayaranFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    /** @use HasFactory<PembayaranFactory> */
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'transaksi_id',
        'metode',
        'jumlah_bayar',
        'bukti_pembayaran',
        'tanggal_bayar',
        'status',
    ];

    protected $attributes = [
        'status' => PaymentStatus::BelumDibayar->value,
    ];

    protected function casts(): array
    {
        return [
            'jumlah_bayar' => 'decimal:2',
            'tanggal_bayar' => 'datetime',
            'metode' => PaymentMethod::class,
            'status' => PaymentStatus::class,
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

    public function verify(): void
    {
        if ($this->status !== PaymentStatus::MenungguVerifikasi) {
            throw new \InvalidArgumentException('Pembayaran hanya dapat diverifikasi saat menunggu verifikasi.');
        }

        $this->status = PaymentStatus::Lunas;
        $this->save();
        $this->transaction()->update(['status_pembayaran' => PaymentStatus::Lunas]);
    }
}
