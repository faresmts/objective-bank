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
            ['message' => 'The account does not exist.'],
            Response::HTTP_NOT_FOUND
        );
    }
}
