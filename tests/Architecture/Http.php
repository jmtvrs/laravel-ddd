<?php

declare(strict_types=1);

arch()
    ->expect('Web\Controllers')
    ->toBeFinal()
    ->toBeReadOnly()
    ->toBeClasses();

arch()
    ->expect('Web\Middleware')
    ->toBeFinal()
    ->toBeReadOnly()
    ->toBeClasses();

arch()
    ->expect('Web\Providers')
    ->toBeFinal()
    ->toBeClasses()
    ->toExtend('Illuminate\Support\ServiceProvider');

arch()
    ->expect('Web\Requests')
    ->toBeFinal()
    ->toBeClasses()
    ->toExtend('Illuminate\Foundation\Http\FormRequest')
    ->toBeUsedIn('Web\Controllers');

arch()
    ->expect('Web\Traits')
    ->toBeTraits();

// // arch()
// //     ->expect('Web\Resources')
// //     ->toBeUsedIn('Web\Controllers\Api');

arch()
    ->expect('App\Http')
    ->toOnlyBeUsedIn('App\Http');
