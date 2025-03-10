<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(
            ['message' => __('validation.account_not_found')],
            Response::HTTP_NOT_FOUND
        );
    }
}
