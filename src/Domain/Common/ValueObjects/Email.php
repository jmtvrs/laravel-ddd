<?php

declare(strict_types=1);

namespace Domain\Common\ValueObjects;

use Domain\Common\Exceptions\IncorrectEmailFormatException;
use Domain\Common\Exceptions\RequiredException;
use Domain\Common\Models\ValueObject;

final class Email extends ValueObject
{
    private string $value;

    public function __construct(?string $value, $isRequired = FALSE)
    {
        if (!$value && $isRequired) {
            throw new RequiredException('email');
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectEmailFormatException;
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
