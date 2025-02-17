<?php

declare(strict_types=1);

namespace Application\User\Dtos;

use Domain\Common\ValueObjects\Email;
use Domain\Common\ValueObjects\Name;
use Domain\Common\ValueObjects\Password;
use Illuminate\Http\Request;

final readonly class CreateUserDto
{
    public readonly Name $name;

    public readonly Email $email;

    public readonly Password $password;

    public function __construct(
        string $name,
        string $email,
        string $password
    ) {
        $this->name = new Name($name, TRUE);
        $this->email = new Email($email, TRUE);
        $this->password = new Password($password);
    }

    public static function fromRequest(Request $request): self
    {
        $data = $request->fluent();

        return new self(
            name: $data->name,
            email: $data->email,
            password: $data->password
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
