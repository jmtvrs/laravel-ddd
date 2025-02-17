<?php

declare(strict_types=1);

namespace Application\User\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

final class UserLogoutListener
{
    public function handle(Logout $event)
    {
        Log::debug('User logged out.', [
            'user_id' => optional($event->user)->id,
            'email' => optional($event->user)->email,
            'time' => now(),
        ]);
    }
}
