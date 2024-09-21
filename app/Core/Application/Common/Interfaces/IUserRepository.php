<?php

namespace App\Core\Application\Common\Interfaces;

use App\Core\Domain\Models\User;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{
    public function getAllUsers(): Collection;
    public function getUserById(UuidInterface $id): User;
    public function getUserBy(string $field, string $value): User;
    public function deleteUser(User $user): bool|null;
    public function createUser(array $attributes): User;
    public function updateUser(User $user, array $attributes): bool;
}
