<?php

declare(strict_types=1);

namespace Application\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        \Domain\User\Events\RegisteredUser::class => [
            // \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
            \Application\User\Listeners\SendWelcomeEmailListener::class,
        ],
        \Domain\User\Events\UserLockout::class => [
            \Application\User\Listeners\UserLockoutListener::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
            \Application\User\Listeners\UserLogoutListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Event::listen();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return FALSE;
    }
}
