<?php

namespace Domain\Transfer;

use App\Enums\PaymentTypeEnum;
use App\Exceptions\InsufficientBalanceException;
use App\Models\Account;
use App\Models\Transfer;

class TransferService
{
    /**
     * @throws InsufficientBalanceException
     */
    public function transfer(array $data)
    {
        $account = Account::query()
            ->where('number', $data['numero_conta'])
            ->first();

        [$fee, $transferValueInCents, $rawValueInCents] = $this->applyFee($data);

        if ($account->balance < $transferValueInCents) {
            throw new InsufficientBalanceException();
        }

        $account->update([
            'balance' => $account->balance - $transferValueInCents,
        ]);

        Transfer::query()->create([
            'payment_type' => $data['forma_pagamento'],
            'account_id' => $account->id,
            'raw_value' => $rawValueInCents,
            'value' => $transferValueInCents,
            'fee' => $fee,
        ]);

        return $account->refresh();
    }

    private function applyFee(array $data): array
    {
        $paymentType = PaymentTypeEnum::from($data['forma_pagamento']);

        $fee = match ($paymentType) {
            PaymentTypeEnum::PIX => 0,
            PaymentTypeEnum::DEBIT => 0.03,
            PaymentTypeEnum::CREDIT => 0.05,
        };

        $rawValue = $data['valor'];
        $rawValueInCents = convert_to_cents($rawValue);

        $valueWithFee = $rawValue * (1 + $fee);
        $valueWithFeeInCents = convert_to_cents($valueWithFee);

        return [$fee, $valueWithFeeInCents, $rawValueInCents];
    }
}
