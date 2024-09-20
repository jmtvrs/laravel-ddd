<?php

declare(strict_types=1);

use App\External\Web\Http\Controllers\Api\V1\AuthenticationController;
use App\External\Web\Http\Controllers\Api\V1\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::post('register', RegisterUserController::class)->name('register');

    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
});

Route::post('logout', [AuthenticationController::class, 'logout'])
    ->middleware('auth:sanctum');
