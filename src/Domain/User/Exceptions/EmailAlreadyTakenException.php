<?php

declare(strict_types=1);

namespace Application\User\Exceptions;

use Exception;

class EmailAlreadyTakenException extends Exception
{
    protected $message = 'Email is already taken.';
}
