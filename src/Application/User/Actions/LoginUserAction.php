<?php

declare(strict_types=1);

namespace Application\User\Actions;

use Application\Common\Interfaces\Persistence\IUserRepository;
use Application\User\Dtos\LoginUserDto;
use Application\User\Events\UserLockout;
use Application\User\Exceptions\InvalidCredentialsException;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final readonly class LoginUserAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
        private readonly RateLimiter $rateLimiter
    ) {}

    public function execute(LoginUserDto $command): ?string
    {
        $this->ensureIsNotRateLimited($command->email);

        $user = $this->userRepository->getBy('email', $command->email);

        if (!$user || !Hash::check($command->password, $user->password)) {
            $this->rateLimiter->hit($this->throttleKey($command->email));
            throw new InvalidCredentialsException("Invalid credentials for '{$command->email}'.");
        }

        $this->rateLimiter->clear($this->throttleKey($command->email));

        return $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(string $email): void
    {
        if (!$this->rateLimiter->tooManyAttempts($this->throttleKey($email), 5)) {
            return;
        }

        event(new UserLockout($email));

        $seconds = $this->rateLimiter->availableIn($this->throttleKey($email));

        throw new InvalidCredentialsException("Too many login attempts with email '{$email}'. Please try again in {$seconds} seconds.");
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(string $email): string
    {
        return Str::transliterate(Str::lower($email));
    }
}
