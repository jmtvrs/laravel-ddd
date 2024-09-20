<?php

declare(strict_types=1);

namespace App\External\Web\Http\Controllers\Api\V1;

use App\Core\Application\Services\Authentication\AuthenticationService;
use App\External\Dtos\AuthenticationResponse;
use App\External\Dtos\RegisterRequest;
use App\External\Web\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class RegisterUserController extends Controller
{
    private AuthenticationService $userService;

    public function __construct(AuthenticationService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {

        $user = $this->userService->createUser(
            $request->firstName,
            $request->lastName,
            $request->email,
            $request->password
        );

        return response()
            ->json(
                new AuthenticationResponse(
                    $user->id,
                    $user->firstName,
                    $user->lastName,
                    $user->email,
                    $user->token,
                )
            );
    }
}
