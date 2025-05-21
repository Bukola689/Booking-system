<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Subscribers\Auth\RegisterSubscriber;
use App\Subscribers\Auth\UpdateProfileSubscriber;
use App\Subscribers\Auth\LoginSubscriber;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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

        // UserRegister::class => [
        //     RegisterNotification::class,
        // ],

      
    ];

    /**
     * The event subscriber classes to register.
     *
     * @var array
     */
     protected $subscribe = [
        RegisterSubscriber::class,
        LoginSubscriber::class,
        UpdateProfileSubscriber::class,
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
}
