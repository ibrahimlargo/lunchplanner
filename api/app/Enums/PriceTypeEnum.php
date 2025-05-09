<?php

declare(strict_types=1);

namespace App\Enums;

enum PriceTypeEnum: string
{
    case Net = 'net';
    case Gross= 'gross';

    public function adjustPriceForType(int $price): int
    {
        return match ($this) {
            self::Net => $price,
            self::Gross => (int) round($price + (7/100 * $price)),
        };
    }

}
