<?php

namespace App\Providers;

use App\Events\SeriesCreatedEvent;
use App\Listeners\EmailUsersAboutSeriesCreated;
use App\Listeners\SeriesCreatedLog;

use App\Events\SeriesDeletedEvent;
use App\Listeners\SeriesDeleted;
use App\Listeners\SeriesDeletedFiles;
use App\Listeners\SeriesDeletedLog;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SeriesCreatedEvent::class => [
            EmailUsersAboutSeriesCreated::class,
            SeriesCreatedLog::class,
        ],
        SeriesDeletedEvent::class => [
            SeriesDeleted::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
