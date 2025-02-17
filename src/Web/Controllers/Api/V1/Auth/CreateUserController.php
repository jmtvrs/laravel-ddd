<?php

declare(strict_types=1);

namespace Web\Controllers\Api\V1\Auth;

use Application\User\Actions\CreateUserAction;
use Application\User\Dtos\CreateUserDto;
use Application\User\Exceptions\EmailAlreadyTakenException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Web\Requests\User\CreateUserRequest;

final readonly class CreateUserController
{
    public function __invoke(CreateUserRequest $request, CreateUserAction $action)
    {
        try {
            $token = $action->execute(CreateUserDto::fromRequest($request));

            return response()
                ->json(['access_token' => $token], Response::HTTP_CREATED);
        } catch (EmailAlreadyTakenException $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
