<?php

declare(strict_types=1);

namespace App\Core\Application\Services\Authentication;

final class AuthenticationResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $token
    ) {}
}
