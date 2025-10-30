<?php

use App\Models\User;
use App\Enums\Role;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create(['role' => Role::USER]);
    $this->actingAs($user);

    $response = $this->get(route('user.dashboard'));
    $response->assertStatus(200);
});