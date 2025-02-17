<?php

declare(strict_types=1);

namespace Application\User\Dtos;

use Illuminate\Contracts\Auth\Authenticatable;

final readonly class LogoutUserDto
{
    public function __construct(public readonly Authenticatable $user) {}
}
