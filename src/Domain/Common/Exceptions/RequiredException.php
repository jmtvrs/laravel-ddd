<?php

declare(strict_types=1);

namespace Domain\Common\Exceptions;

class RequiredException extends \DomainException
{
    public function __construct($fieldName)
    {
        parent::__construct(trans('validation.required', ['attribute' => $fieldName]));
    }
}
