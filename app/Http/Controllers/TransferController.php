<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientBalanceException;
use App\Http\Requests\StoreTransferRequest;
use App\Http\Resources\AccountResource;
use Domain\Transfer\TransferService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TransferController extends Controller
{
    public function __construct(
        private readonly TransferService $service
    ){}

    /**
     * @throws InsufficientBalanceException
     */
    public function store(StoreTransferRequest $request): JsonResponse
    {
        $account = $this->service->transfer($request->validated());

        return response()->json(
            AccountResource::make($account),
            Response::HTTP_CREATED
        );
    }
}
