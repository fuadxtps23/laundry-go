<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Direct = 'direct';
    case Qris = 'qris';
    case Transfer = 'transfer';

    public function label(): string
    {
        return match ($this) {
            self::Direct => 'Direct (Cash)',
            self::Qris => 'Scan QR (QRIS)',
            self::Transfer => 'Transfer Bank',
        };
    }

    /** @return list<string> */
    public static function values(): array
    {
        return array_map(static fn (self $method): string => $method->value, self::cases());
    }
}
