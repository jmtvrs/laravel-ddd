<?php

declare(strict_types=1);

namespace Domain\Common\Models;

use JsonSerializable;

abstract class Entity implements JsonSerializable
{
    abstract public function toArray(): array;

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
