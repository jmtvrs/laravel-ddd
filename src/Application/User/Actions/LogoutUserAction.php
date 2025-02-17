<?php

declare(strict_types=1);

namespace Application\User\Actions;

use Application\User\Dtos\LogoutUserDto;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;

final readonly class LogoutUserAction
{
    public function execute(LogoutUserDto $command): void
    {
        $guard = Auth::getDefaultDriver();
        $command->user->tokens()->delete();

        event(new Logout($guard, $command->user));
    }
}
