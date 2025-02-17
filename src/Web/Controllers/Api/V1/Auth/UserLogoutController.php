<?php

declare(strict_types=1);

namespace Web\Controllers\Api\V1\Auth;

use Application\User\Actions\LogoutUserAction;
use Application\User\Dtos\LogoutUserDto;

final readonly class UserLogoutController
{
    public function __construct(public readonly LogoutUserAction $action) {}

    public function __invoke()
    {
        $command = new LogoutUserDto(auth()->user());
        $this->action->execute($command);

        return response()->noContent();
    }
}
