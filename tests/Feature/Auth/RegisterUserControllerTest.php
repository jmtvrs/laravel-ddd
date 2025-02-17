<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response;

it('register a user', function () {
    // Assert
    $this->assertDatabaseEmpty(User::class);

    // Arrange
    Event::fake();
    $user = [
        'name' => 'Dummy User Name',
        'email' => 'dummy.user@email.com',
        'password' => 'dummy.password',
    ];

    // Act
    $response = $this->post(
        route('auth.user.register'),
        $user
    );

    // Assert
    $response
        ->assertStatus(Response::HTTP_OK);

    expect($response->content())
        ->json()
        ->toBe([
            'access_token' => $response->json('access_token'),
        ]);

    $this->assertDatabaseCount('users', 1);

    Event::assertDispatched(Registered::class);
});

it('fails to register a user with bad password', function () {

    // Arrange
    Event::fake();
    $user = [
        'name' => 'Dummy User Name',
        'email' => 'dummy.user@email.com',
        'password' => 'pw',
    ];

    // Act
    $response = $this->post(
        route('auth.user.register'),
        $user
    );

    // Assert
    $response
        ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    $this->assertDatabaseEmpty(User::class);

    Event::assertNotDispatched(Registered::class);
});
