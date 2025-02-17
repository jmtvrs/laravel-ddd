<?php

declare(strict_types=1);

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

test('users can logout', function () {

    // Arrange
    $user = User::factory()->create();
    Sanctum::actingAs($user, ['*']);

    // Act
    $response = $this->postJson(route('auth.user.logout'));

    // Assert
    $response->assertStatus(Response::HTTP_NO_CONTENT);

    // Ensure tokens are deleted
    expect($user->tokens()->count())->toBe(0);
});
