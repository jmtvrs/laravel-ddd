<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Web\Controllers\Api\V1\Auth\CreateUserController;
use Web\Controllers\Api\V1\Auth\UserLoginController;
use Web\Controllers\Api\V1\Auth\UserLogoutController;

Route::group([
    'as' => 'auth.',
    'prefix' => 'auth',
], function () {

    Route::middleware('guest')->group(function () {
        Route::post('register', CreateUserController::class)
            ->name('user.register');
        Route::post('login', UserLoginController::class)
            ->name('user.login');
    });

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('logout', UserLogoutController::class)
            ->name('user.logout');

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('get.user');
    });
});
