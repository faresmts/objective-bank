<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'balance'
    ];

    public function getFormattedBalanceAttribute(): string
    {
        return number_format($this->balance, 2, ',', '.');
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }
}
