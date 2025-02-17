<?php

declare(strict_types=1);

// arch()->preset()->laravel();
arch()->preset()->php();
// arch()->preset()->relaxed();
arch()->preset()->security(); // ->ignoring('md5');
// arch()->preset()->strict();

arch()
    ->expect('env')
    ->not->toBeUsed();

arch()
    ->expect('App')
    ->toUseStrictTypes()
    ->not->toUse(['dd', 'dump', 'ddd', 'print_r', 'dump', 'print', 'exit', 'die', 'logger', 'ray']);

// arch('app')
//     ->expect('App')
//     ->toHaveMethodsDocumented();
