<?php

it('blocks equipment access without a token', function () {
    $response = $this->getJson('/api/equipment');

    $response->assertStatus(401);
});

it('blocks user information access without a token', function () {
    $response = $this->getJson('/api/me');

    $response->assertStatus(401);
});

it('blocks logout without a token', function () {
    $response = $this->postJson('/api/logout');

    $response->assertStatus(401);
});
