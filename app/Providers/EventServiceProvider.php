<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Request;
use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use App\Observers\ContactObserver;
use App\Observers\RequestObserver;
use App\Observers\TeamInvitationObserver;
use App\Observers\TeamObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        TeamInvitation::observe(TeamInvitationObserver::class);
        Team::observe(TeamObserver::class);
        User::observe(UserObserver::class);
    }
}
