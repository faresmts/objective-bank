<?php

namespace App\Enums;

enum PaymentTypeEnum: string
{
    case DEBIT = 'D';
    case CREDIT = 'C';
    case PIX = 'P';
}
