<?php

declare(strict_types=1);

namespace Application\Common\Interfaces\Persistence;

use Domain\Common\ValueObjects\Guid;
use Domain\Entities\User;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function getAll(): Collection;

    public function getById(Guid $id): ?User;

    public function getBy(string $field, string $value): ?User;

    public function delete(User $user): bool;

    public function create(User $user): bool;

    public function update(User $user): bool;
}
