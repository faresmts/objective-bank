<?php

namespace Domain\Account;

use App\Models\Account;

class AccountService
{
    public function storeAccount(array $accountData): Account
    {
        $balanceInCents = convert_to_cents($accountData['saldo']);

        return Account::query()
            ->create([
                'number' => $accountData['numero_conta'],
                'balance' => $balanceInCents,
            ]);
    }

    public function findAccount(array $requestData): Account
    {
        return Account::query()
            ->where('number', $requestData['numero_conta'])
            ->first();
    }
}
