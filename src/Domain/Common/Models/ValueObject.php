<?php

declare(strict_types=1);

namespace Domain\Common\Models;

use JsonSerializable;

abstract class ValueObject implements JsonSerializable
{
    abstract public function getValue();

    public function splitField(?string $field, $max_length = 80): array
    {
        return explode(PHP_EOL, wordwrap($field ? (string) $this->{$field} : $this->jsonSerialize(), $max_length, PHP_EOL));
    }

    public function equals(ValueObject $other): bool
    {
        return $this->jsonSerialize() === $other->jsonSerialize();
    }
}
