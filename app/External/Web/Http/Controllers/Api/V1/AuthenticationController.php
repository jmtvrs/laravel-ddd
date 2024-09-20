<?php

declare(strict_types=1);

namespace App\External\Web\Http\Controllers\Api\V1;

use App\Core\Application\Services\Authentication\AuthenticationService;
use App\External\Dtos\AuthenticationResponse;
use App\External\Dtos\LoginRequest;
use App\External\Web\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

final class AuthenticationController extends Controller
{
    private AuthenticationService $userService;

    public function __construct(AuthenticationService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $request->ensureIsNotRateLimited();

        $user = $this->userService->authenticate(
            $request->email,
            $request->password,
            $request->remember,
            $request->ip()
        );

        if ($user === NULL) {
            RateLimiter::hit($request->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($request->throttleKey());

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

    public function logout(): JsonResponse
    {
        $this->userService->logout();

        return response()->json(['message' => trans('auth.logged_out')]);
    }
}
