<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'numero_conta' => ['required', 'integer', 'unique:accounts,number'],
            'saldo' => ['required', 'numeric'],
        ];
    }
}
