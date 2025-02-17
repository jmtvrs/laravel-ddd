<?php

declare(strict_types=1);

namespace Application\User\Listeners;

use Application\User\Jobs\SendWelcomeEmailJob;
use Domain\User\Events\RegisteredUser;

final class SendWelcomeEmailListener
{
    public function handle(RegisteredUser $event)
    {
        dispatch(new SendWelcomeEmailJob($event->user));
    }
}
