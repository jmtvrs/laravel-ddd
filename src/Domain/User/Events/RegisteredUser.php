<?php

declare(strict_types=1);

namespace Domain\User\Events;

use Domain\Entities\User;
use Illuminate\Foundation\Events\Dispatchable;

class RegisteredUser
{
    use Dispatchable;

    public function __construct(public User $user) {}
}
