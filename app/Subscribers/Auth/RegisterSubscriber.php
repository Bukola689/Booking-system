<?php

namespace App\Subscribers\Auth;
use Illuminate\Events\Dispatcher;
use App\Listeners\Models\Auth\RegisterNotification;
use App\Events\Models\Auth\UserRegister;

class RegisterSubscriber
{
    public function subscribe(Dispatcher $events)
    {
    
         /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
        $events->listen(
            UserRegister::class,
            RegisterNotification::class, 
        );
      
    }
}