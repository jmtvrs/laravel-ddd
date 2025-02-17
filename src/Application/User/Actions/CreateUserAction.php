<?php

declare(strict_types=1);

namespace Application\User\Actions;


use Application\Common\Interfaces\Persistence\IUserRepository;
use Application\User\Dtos\CreateUserDto;
use Application\User\Services\UserService;
use Domain\User\Events\RegisteredUser;
use Illuminate\Support\Facades\DB;

use Domain\Entities\User;

final readonly class CreateUserAction
{
    public function __construct(
        private readonly IUserRepository $userRepository,
        private readonly UserService $UserService
    ) {}

    public function execute(CreateUserDto $command): ?string
    {
        $token = NULL;

        DB::transaction(function () use ($command, &$token) {

            $this->UserService->ensureEmailIsUnique($command->email);

            $user = new User;
            $user->name = $command->name;
            $user->email = $command->email;
            $user->password = $command->password;

            $result = $this->userRepository->create($user);

            event(new RegisteredUser($user));

            $token = $user->createToken('auth_token')->plainTextToken;
        });

        return $token;
    }
}
