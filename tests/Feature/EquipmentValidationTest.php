<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    Sanctum::actingAs(User::factory()->create());
});

it('rejects equipment with missing quantity', function () {
    $response = $this->postJson('/api/equipment', [
        'name' => 'Keyboard',
        'category' => 'Computer',
        'location' => 'Room 102',
        'condition' => 'Good',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['quantity']);
});

it('rejects equipment with negative quantity', function () {
    $response = $this->postJson('/api/equipment', [
        'name' => 'Keyboard',
        'category' => 'Computer',
        'location' => 'Room 102',
        'quantity' => -5,
        'condition' => 'Good',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['quantity']);
});

it('accepts equipment with valid information', function () {
    $response = $this->postJson('/api/equipment', [
        'name' => 'Keyboard',
        'category' => 'Computer',
        'location' => 'Room 102',
        'quantity' => 15,
        'condition' => 'Good',
    ]);

    $response->assertStatus(201);
});
