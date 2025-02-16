<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->randomNumber(3),
            'balance' => $this->faker->randomFloat(2, 0, 100000),
        ];
    }
}
