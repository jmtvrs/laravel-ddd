<?php

declare(strict_types=1);

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

it('logins user and returns token', function () {
    // Arrange
    $user = User::factory()->create();

    // Act
    $response = $this->post(
        route('auth.user.login'),
        [
            'email' => $user->email,
            'password' => 'password',
        ]
    );

    // Assert
    $response
        ->assertStatus(Response::HTTP_OK);

    expect($response->content())
        ->json()
        ->toBe([
            'access_token' => $response->json('access_token'),
        ]);
});
