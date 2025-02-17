<?php

namespace App\Http\Requests;

use App\Enums\PaymentTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransferRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'forma_pagamento' => ['required', 'string', 'in:'. PaymentTypeEnum::validationString()],
            'numero_conta' => ['required', 'integer', 'exists:accounts,number'],
            'valor' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function messages(): array
    {
        return [
            'numero_conta.exists' => __('validation.account_not_found'),
        ];
    }
}
