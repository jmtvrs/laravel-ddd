<?php

declare(strict_types=1);

namespace Infrastructure\Providers;

use Application\Common\Interfaces\Persistence\IUserRepository;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Repositories\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
