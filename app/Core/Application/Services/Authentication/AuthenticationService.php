<?php

namespace App\Core\Application\Services\Authentication;

use App\Core\Domain\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;

final class AuthenticationService
{
    public function createUser(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ): AuthenticationResult {

        $user = User::create([
            'id' => Str::uuid(),
            'name' => $firstName . ' ' . $lastName,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        event(new Registered($user));

        return new AuthenticationResult(
            $user->id,
            $user->name,
            $user->name,
            $user->email,
            $user->createToken('MyApp')->plainTextToken,
        );
    }
}
