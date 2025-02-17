<?php

declare(strict_types=1);

return [
    \Application\Providers\AppServiceProvider::class,
    \Application\Providers\EventServiceProvider::class,
    \Infrastructure\Providers\RepositoryServiceProvider::class,
    \Web\Providers\RouteServiceProvider::class,
];
