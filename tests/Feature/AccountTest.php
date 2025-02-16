<?php

use App\Models\Account;

test('create an account successfully', function () {
    $response = $this->post(route('accounts.store'), [
        'numero_conta' => 234,
        'saldo' => 180.37,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => 234,
            'saldo' => 180.37,
        ]);
});

test('view a account data successfully', function () {
    $account = Account::factory()->create();

    $response = $this->get(route('accounts.show', ['numero_conta' => $account->number]));

    $response->assertOk()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => $account->formatted_balance,
        ]);
});

test('it is not allowed to create an account when it already exists', function () {
    Account::factory()->create([
        'number' => 234,
    ]);

    $response = $this->post(route('accounts.store'), [
        'numero_conta' => 234,
        'saldo' => 180.37,
    ]);

    $response->assertUnprocessable();
});

test('is not allowed to view an account that doesn\'t exist', function () {
    $response = $this->get(route('accounts.show', ['numero_conta' => 1]));

    $response->assertNotFound();
});


