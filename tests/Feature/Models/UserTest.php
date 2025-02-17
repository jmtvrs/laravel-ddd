<?php

declare(strict_types=1);

use App\Models\User;

it('creates users', function () {
    // Arrange
    User::factory()->create();

    // Act & Assert
    $this->assertDatabaseCount('users', 1);
});
