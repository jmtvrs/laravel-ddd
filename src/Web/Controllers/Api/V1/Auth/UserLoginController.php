<?php

declare(strict_types=1);

namespace Web\Controllers\Api\V1\Auth;

use Application\User\Actions\LoginUserAction;
use Application\User\Dtos\LoginUserDto;
use Application\User\Exceptions\InvalidCredentialsException;
use Symfony\Component\HttpFoundation\Response;
use Web\Requests\User\LoginRequest;

final readonly class UserLoginController
{
    public function __invoke(LoginRequest $request, LoginUserAction $action)
    {
        try {
            $data = $request->fluent();
            $command = new LoginUserDto(
                $data->email,
                $data->password,
                $request->ip(),
            );

            $token = $action->execute($command);

            return response()
                ->json(['access_token' => $token], Response::HTTP_CREATED);
        } catch (InvalidCredentialsException $e) {
            return response()
                ->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
