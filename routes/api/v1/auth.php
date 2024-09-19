<?php

use Illuminate\Support\Facades\Route;
use App\External\Web\Http\Controllers\Api\V1\RegisterUserController;

Route::post('register', RegisterUserController::class)->name('register')->middleware('guest');
