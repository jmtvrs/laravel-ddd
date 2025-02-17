<?php

declare(strict_types=1);

arch()
    ->expect('Application\Providers')
    ->toBeClasses()
    ->toExtend('Illuminate\Support\ServiceProvider');

// User
arch()
    ->expect('Application\User\Actions')
    ->toBeFinal()
    ->toBeReadOnly()
    ->toBeClasses()
    // ->toBeInvokable()
    ->toHaveSuffix('Action')
    ->toHaveMethod('execute');

arch()
    ->expect('Application\User\Dtos')
    ->toBeFinal()
    ->toBeReadOnly()
    ->toBeClasses()
    ->toExtendNothing()
    ->toHaveSuffix('Dto')
    ->toBeUsedIn('Application\User\Actions');

arch()
    ->expect('Application\User\Emails')
    ->toBeClasses()
    ->toHaveSuffix('Email')
    ->toExtend('Illuminate\Mail\Mailable');

arch()
    ->expect('Application\User\Jobs')
    ->toBeClasses()
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue')
    ->toHaveSuffix('Job')
    ->toHaveMethod('handle');

arch()
    ->expect('Application\User\Listeners')
    ->toBeFinal()
    ->toBeClasses()
    ->toHaveSuffix('Listener')
    ->toHaveMethod('handle');
