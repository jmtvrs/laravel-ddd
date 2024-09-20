<?php

namespace App\Core\Application\Services\Authentication;

use App\Core\Domain\Models\User;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Auth\Events\Login;
// use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $this->generateUserToken($user),
        );
    }

    public function authenticate(
        string $email,
        string $password
    ): AuthenticationResult|null {

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            return new AuthenticationResult(
                $user->id,
                $user->name,
                $user->name,
                $user->email,
                $this->generateUserToken($user),
            );
        }

        return null;
    }

    public function logout(): void
    {
        //Auth::user()?->currentAccessToken()->delete();
        auth()->user()->tokens()->delete();
    }

    private function generateUserToken(User $user): string
    {
        return $user->createToken($user->name . '-AuthToken')->plainTextToken;
    }
}
