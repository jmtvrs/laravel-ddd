<?php

namespace App\External\Infrastructure\Users\Persistance;

use App\Core\Application\Common\Interfaces\IUserRepository;
use App\Core\Domain\Models\User;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements IUserRepository
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function getUserById(UuidInterface $id): User
    {
        return User::findOrFail($id);
    }

    public function getUserBy(string $field, string $value): User
    {
        return User::where($field, $value)->firstOrFail();
    }

    public function deleteUser(User $user): bool|null
    {
        return $user->delete();
    }

    public function createUser(array $attributes): User
    {
        return User::create($attributes);
    }

    public function updateUser(User $user, array $attributes): bool
    {
        return $user->update($attributes);
    }
}
