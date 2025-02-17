<?php

declare(strict_types=1);

namespace Domain\Entities;

use Domain\Common\Models\Entity;
use Domain\Common\ValueObjects\Email;
use Domain\Common\ValueObjects\Guid;
use Domain\Common\ValueObjects\Name;
use Domain\Common\ValueObjects\Password;

final class User extends Entity
{
    public Guid $id;

    public Name $name;

    public Email $email;

    public Password $password;

    public function __set($name, $value)
    {
        throw new \LogicException("Cannot update property '{$name}' after initialization.");
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
