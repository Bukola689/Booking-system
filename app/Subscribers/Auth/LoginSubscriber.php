<?php

namespace App\Subscribers\Auth;
use Illuminate\Events\Dispatcher;
use App\Listeners\Models\Auth\LoginNotification;
use App\Events\Models\Auth\UserLogin;

class LoginSubscriber
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
            UserLogin::class,
            LoginNotification::class, 
        );
      
    }
}