<?php

declare(strict_types=1);

namespace Application\User\Listeners;

use Application\User\Events\UserLockout;
use Illuminate\Support\Facades\Log;

final class UserLockoutListener
{
    public function handle(UserLockout $event)
    {
        Log::warning('User locked out due to excessive login attempts.', [
            'email' => $event->email,
        ]);
    }
}
