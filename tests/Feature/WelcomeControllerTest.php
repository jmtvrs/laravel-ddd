<?php

declare(strict_types=1);

it('returns a successful response', function () {
    // Act
    $response = $this->get('/');

    // Assert
    $response->assertStatus(200);

    expect($response->content())
        ->json()
        ->toBe([
            'service' => 'Laravel',
            'release' => NULL,
            'version' => NULL,
            'env' => 'testing',
        ]);
});
