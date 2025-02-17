<?php

declare(strict_types=1);

namespace Domain\User\Events;

use Domain\Common\ValueObjects\Email;
use Illuminate\Foundation\Events\Dispatchable;

class UserLockout
{
    use Dispatchable;

    public function __construct(public Email $email) {}
}
