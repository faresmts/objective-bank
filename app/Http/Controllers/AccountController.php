<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowAccountRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Resources\AccountResource;
use Domain\Account\AccountService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function __construct(
        public AccountService $service
    ){}

    public function store(StoreAccountRequest $request): JsonResponse
    {
        return response()->json(
            AccountResource::make(
                $this->service->storeAccount($request->validated())
            ),
            Response::HTTP_CREATED
        );
    }

    public function show(ShowAccountRequest $request): JsonResponse
    {
        return response()->json(
            AccountResource::make(
                $this->service->findAccount($request->validated())
            ),
        );
    }
}
