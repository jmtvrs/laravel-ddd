<?php

declare(strict_types=1);

namespace Infrastructure\Persistence\Repositories;

use Application\Common\Interfaces\Persistence\IUserRepository;
use Domain\Common\ValueObjects\Email;
use Domain\Common\ValueObjects\Guid;
use Domain\Common\ValueObjects\Name;
use Domain\Entities\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final readonly class UserRepository implements IUserRepository
{
    public function getAll(): Collection
    {
        $rows = DB::table('users')
            ->get()
            ->map(function ($row) {
                $user = new User;
                $user->id = new Guid($row->id);
                $user->name = new Name($row->name);
                $user->email = new Email($row->email);

                return $user;
            });

        return $rows;
    }

    public function getById(Guid $id): ?User
    {
        $row = DB::table('users')->where('id', $id)->first();

        if ($row === NULL) {
            return NULL;
        }

        $user = new User;
        $user->id = new Guid($row->id);
        $user->name = new Name($row->name);
        $user->email = new Email($row->email);

        return $user;
    }

    public function getBy(string $field, string $value): ?User
    {
        $row = DB::table('users')->where($field, $value)->first();

        if ($row === NULL) {
            return NULL;
        }

        $user = new User;
        $user->id = new Guid($row->id);
        $user->name = new Name($row->name);
        $user->email = new Email($row->email);

        return $user;
    }

    public function create(User $user): bool
    {
        return DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => $user->name->getValue(),
            'email' => $user->email->getValue(),
            'password' => Hash::make($user->password->getValue()),
        ]);
    }

    public function delete(User $user): bool
    {
        throw new \Exception('Not implemented');
    }

    public function update(User $user): bool
    {
        throw new \Exception('Not implemented');
    }
}
