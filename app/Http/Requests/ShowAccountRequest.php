<?php

namespace App\Http\Requests;

use App\Rules\ExistsAccount;
use Illuminate\Foundation\Http\FormRequest;

class ShowAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'numero_conta' => ['required', 'integer', new ExistsAccount],
        ];
    }
}
