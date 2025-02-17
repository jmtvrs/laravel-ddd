<?php

declare(strict_types=1);

namespace Application\User\Exceptions;

use Exception;
use Illuminate\Contracts\Debug\ShouldntReport;

class InvalidCredentialsException extends Exception implements ShouldntReport
{
    protected $message = 'Invalid credentials.';
}
