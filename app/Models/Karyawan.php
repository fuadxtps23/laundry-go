<?php

namespace App\Models;

use Database\Factories\KaryawanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    /** @use HasFactory<KaryawanFactory> */
    use HasFactory, Notifiable;

    public const ROLE_KARYAWAN = 'karyawan';

    /** @var list<string> */
    public const POSITIONS = [
        'Operator Cuci',
        'Operator Setrika',
        'Operator Packing',
        'Operator Cuci & Lipat',
        'Kurir',
        'Kasir',
        'Supervisor',
    ];

    protected $table = 'karyawan';

    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'no_hp',
        'posisi_jabatan',
        'password',
        'role',
    ];

    protected $attributes = [
        'role' => self::ROLE_KARYAWAN,
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
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
}
