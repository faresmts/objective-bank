<?php

namespace App\Enums;

enum PaymentTypeEnum: string
{
    case DEBIT = 'D';
    case CREDIT = 'C';
    case PIX = 'P';

    public static function toArray(): array
    {
        return [
            self::DEBIT->value,
            self::CREDIT->value,
            self::PIX->value,
        ];
    }

    public static function validationString(): string
    {
        return implode(',', self::toArray());
    }
}
