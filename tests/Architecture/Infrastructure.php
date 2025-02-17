<?php

declare(strict_types=1);

arch()
    ->expect('Infrastructure\Persistence\Repositories')
    ->toBeFinal()
    ->toBeReadOnly()
    ->toBeClasses();

arch()
    ->expect('Infrastructure\Providers')
    ->toBeFinal()
    ->toBeClasses()
    ->toExtend('Illuminate\Support\ServiceProvider');
