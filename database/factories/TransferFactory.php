<?php

namespace Database\Factories;

use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'account_id' => $this->faker->randomNumber(3),
            'payment_type' => $this->faker->randomElement(PaymentTypeEnum::cases()),
            'raw_value' => $this->faker->randomFloat(2, 0, 100000),
            'value' => $this->faker->randomFloat(2, 0, 100000),
            'fee' => $this->faker->randomFloat(2, 0, 100000),
        ];
    }
}
