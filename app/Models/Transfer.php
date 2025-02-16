<?php

namespace App\Models;

use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'payment_type',
        'raw_value',
        'value',
        'fee'
    ];

    protected $casts = [
        'payment_type' => PaymentTypeEnum::class,
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
