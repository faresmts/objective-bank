<?php

use App\Models\Account;

test('create a transfer successfully', function () {
    $value = 10.00; //in BRL

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 18000, //in BRL cents
    ]);

    $response = $this->post(route('transfers.store'), [
        'forma_pagamento' => 'P',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => $account->formatted_balance - $value,
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_type' => 'P',
        'account_id' => $account->id,
        'value' => $value * 100 //convert to BRL cents,
    ]);
});

test('create a pix transfer successfully with fee', function () {
    $value = 20.00; //in BRL

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 20000, //in BRL cents
    ]);

    $response = $this->post(route('transfers.store'), [
        'forma_pagamento' => 'P',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => 180.00,
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_type' => 'P',
        'account_id' => $account->id,
        'value' => $value * 100 //convert to BRL cents,
    ]);
    $this->assertDatabaseHas('accounts', [
        'numero_conta' => $account->number,
        'saldo' => 180.00,
    ]);
});

test('create a credit card transfer successfully with fee', function () {
    $value = 20.00; //in BRL

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 20000, //in BRL cents
    ]);

    $response = $this->post(route('transfers.store'), [
        'forma_pagamento' => 'C',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => (200.00 - ($value * 1.05)), // 5% fee
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_type' => 'C',
        'account_id' => $account->id,
        'value' => $value * 100 * 1.05 //convert to BRL cents with fee
    ]);
    $this->assertDatabaseHas('accounts', [
        'numero_conta' => $account->number,
        'saldo' => (200.00 - ($value * 1.05)), // 5% fee
    ]);
});

test('create a debit card transfer successfully with fee', function () {
    $value = 20.00; //in BRL

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 20000, //in BRL cents
    ]);

    $response = $this->post(route('transfers.store'), [
        'forma_pagamento' => 'D',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertCreated()
        ->assertJson([
            'numero_conta' => $account->number,
            'saldo' => (200.00 - ($value * 1.03)), // 3% fee
        ]);

    $this->assertDatabaseCount('transfers', 1);
    $this->assertDatabaseHas('transfers', [
        'payment_type' => 'D',
        'account_id' => $account->id,
        'value' => $value * 100 * 1.03 //convert to BRL cents with fee
    ]);

    $this->assertDatabaseHas('accounts', [
        'numero_conta' => $account->number,
        'saldo' => (200.00 - ($value * 1.03)), // 3% fee
    ]);
});

test('is not allowed to create a transfer without an available balance', function () {
    $value = 10.00; //in BRL

    $account = Account::factory()->create([
        'number' => 234,
        'balance' => 10, //in BRL cents
    ]);

    $response = $this->post(route('transfers.store'), [
        'forma_pagamento' => 'P',
        'numero_conta' => $account->number,
        'valor' => $value,
    ]);

    $response->assertNotFound();

    $this->assertDatabaseCount('transfers', 0);
});

