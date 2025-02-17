<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'numero_conta' => ['required', 'integer', 'unique:accounts,number'],
            'saldo' => ['required', 'numeric', 'gte:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'numero_conta.unique' => 'O número da conta informado já está em uso.',
        ];
    }
}
