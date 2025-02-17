<?php

declare(strict_types=1);

namespace Application\User\Dtos;

final readonly class LoginUserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}
}
