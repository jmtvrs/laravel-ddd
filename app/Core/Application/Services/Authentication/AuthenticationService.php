<?php

declare(strict_types=1);

namespace App\Core\Application\Services\Authentication;

use App\Core\Domain\Models\User;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Auth\Events\Login;
// use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Core\Application\Common\Interfaces\IUserRepository;

final class AuthenticationService
{
    public function __construct(
        private readonly IUserRepository $repository
    ) {}

    public function createUser(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ): AuthenticationResult {

        $user = $this->repository->createUser([
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
            $this->generateUserToken($user),
        );
    }

    public function authenticate(
        string $email,
        string $password
    ): ?AuthenticationResult {

        $user = $this->repository->getUserBy('email', $email);

        if ($user && Hash::check($password, $user->password)) {
            return new AuthenticationResult(
                $user->id,
                $user->name,
                $user->name,
                $user->email,
                $this->generateUserToken($user),
            );
        }

        return NULL;
    }

    public function logout(): void
    {
        Auth::user()?->currentAccessToken()->delete();
    }

    public function revokeAllUserTokens(): void
    {
        Auth::user()?->tokens()->delete();
    }

    private function generateUserToken(User $user): string
    {
        return $user->createToken($user->name . '-AuthToken')->plainTextToken;
    }
}
