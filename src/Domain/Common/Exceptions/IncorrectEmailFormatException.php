<?php

declare(strict_types=1);

namespace Domain\Common\Exceptions;

class IncorrectEmailFormatException extends \DomainException
{
    public function __construct()
    {
        parent::__construct(trans('validation.incorrect_email_format'));
    }
}
