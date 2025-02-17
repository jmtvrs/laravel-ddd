<?php

declare(strict_types=1);

namespace Application\User\Services;

use Application\Common\Interfaces\Persistence\IUserRepository;
use Application\User\Exceptions\EmailAlreadyTakenException;
use Domain\Common\ValueObjects\Email;

class UserService
{
    public function __construct(private readonly IUserRepository $userRepository) {}

    public function ensureEmailIsUnique(Email $email): void
    {
        if ($this->userRepository->getBy('email', $email->getValue())) {
            throw new EmailAlreadyTakenException(trans('user.taken_email', ['email' => $email]));
        }
    }
}
