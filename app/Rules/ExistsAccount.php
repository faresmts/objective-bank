<?php

namespace App\Rules;

use App\Exceptions\AccountNotFoundException;
use App\Models\Account;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistsAccount implements ValidationRule
{
    /**
     * @throws AccountNotFoundException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Account::query()->where('number', $value)->exists()) {
            throw new AccountNotFoundException();
        }
    }
}
