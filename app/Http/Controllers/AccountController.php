<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowAccountRequest;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function store(StoreAccountRequest $request): JsonResponse
    {
        $data = $request->validated();
        $balance = $data['saldo'] * 100;

        $data = Account::query()
            ->create([
                'number' => $data['numero_conta'],
                'balance' => (int) $balance,
            ]);

        return response()->json(
            AccountResource::make($data),
            201
        );
    }

    public function show(ShowAccountRequest $request): JsonResponse
    {
        $data = $request->validated();
        $account = Account::query()
            ->where('number', $data['numero_conta'])
            ->first();

        return response()->json(
            AccountResource::make($account),
        );
    }
}
