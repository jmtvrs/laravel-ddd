<?php

namespace App\Core\Application\Services\Authentication;

class AuthenticationResult
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $token
    ) {}
}
