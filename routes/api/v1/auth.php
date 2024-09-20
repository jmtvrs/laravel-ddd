<?php

declare(strict_types=1);

use App\External\Web\Http\Controllers\Api\V1\AuthenticationController;
use App\External\Web\Http\Controllers\Api\V1\RegisterUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function () {

    Route::post('register', RegisterUserController::class)->name('register');

    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('logged-in-user');

    Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
});



