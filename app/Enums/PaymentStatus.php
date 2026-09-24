<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case BelumDibayar = 'belum_dibayar';
    case MenungguVerifikasi = 'menunggu_verifikasi';
    case Lunas = 'lunas';

    public function label(): string
    {
        return match ($this) {
            self::BelumDibayar => 'Belum dibayar',
            self::MenungguVerifikasi => 'Menunggu verifikasi',
            self::Lunas => 'Lunas',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::BelumDibayar => 'bg-red-100 text-red-800',
            self::MenungguVerifikasi => 'bg-amber-100 text-amber-800',
            self::Lunas => 'bg-emerald-100 text-emerald-800',
        };
    }

    /** @return list<string> */
    public static function values(): array
    {
        return array_map(static fn (self $status): string => $status->value, self::cases());
    }
}
