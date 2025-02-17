<?php

declare(strict_types=1);

namespace Domain\Common\ValueObjects;

use Domain\Common\Exceptions\RequiredException;
use Domain\Common\Models\ValueObject;

final class Name extends ValueObject
{
    private string $value;

    public function __construct(?string $value, $isRequired = FALSE)
    {
        if (!$value && $isRequired) {
            throw new RequiredException('name');
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
