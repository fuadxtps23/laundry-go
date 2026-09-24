<?php

namespace App\Enums;

enum LaundryStatus: string
{
    case Menunggu = 'menunggu';
    case Diproses = 'diproses';
    case Selesai = 'selesai';
    case Diambil = 'diambil';

    public function next(): ?self
    {
        return match ($this) {
            self::Menunggu => self::Diproses,
            self::Diproses => self::Selesai,
            self::Selesai => self::Diambil,
            self::Diambil => null,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Menunggu => 'Menunggu',
            self::Diproses => 'Diproses',
            self::Selesai => 'Selesai',
            self::Diambil => 'Diambil',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::Menunggu => 'bg-amber-100 text-amber-800',
            self::Diproses => 'bg-blue-100 text-blue-800',
            self::Selesai => 'bg-emerald-100 text-emerald-800',
            self::Diambil => 'bg-stone-100 text-stone-700',
        };
    }

    /** @return list<string> */
    public static function values(): array
    {
        return array_map(static fn (self $status): string => $status->value, self::cases());
    }
}
