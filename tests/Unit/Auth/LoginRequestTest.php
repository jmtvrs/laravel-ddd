<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Web\Requests\Auth\LoginRequest;

// Help from https://mauricius.dev/testing-approaches-for-laravel-form-requests/

it('ensures rate limit is active', function () {
    // Arrange
    Event::fake();

    RateLimiter::partialMock()
        ->shouldReceive('tooManyAttempts')
        ->once()
        ->andReturn(TRUE);

    RateLimiter::partialMock()
        ->shouldReceive('availableIn')
        ->once()
        ->andReturn(60);

    // Act
    $loginRequest = new LoginRequest;

    // Assert
    expect(fn () => $loginRequest->ensureIsNotRateLimited())
        ->toThrow(ValidationException::class);

    Event::assertDispatched(Lockout::class);
});

it('fails to authenticate with invalid credentials', function () {
    // Arrange
    RateLimiter::partialMock()
        ->shouldReceive('tooManyAttempts')
        ->once()
        ->andReturn(FALSE);

    RateLimiter::shouldReceive('hit')->once();

    Auth::shouldReceive('attempt')
        ->once()
        ->andReturn(FALSE);

    // Act
    $loginRequest = new LoginRequest;

    // Assert
    expect(fn () => $loginRequest->authenticate())
        ->toThrow(ValidationException::class);
});
