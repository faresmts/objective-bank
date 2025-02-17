<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InsufficientBalanceException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(
            ['message' => __('validation.insufficient_balance')],
            Response::HTTP_NOT_FOUND
        );
    }
}
