<?php

namespace App\External\Infrastructure;

use Illuminate\Support\ServiceProvider;
use App\External\Infrastructure\Users\Persistance\UserRepository;
use App\Core\Application\Common\Interfaces\IUserRepository;

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
