<?php

namespace App\Subscribers\Auth;
use Illuminate\Events\Dispatcher;
use App\Listeners\Models\Auth\ChangePasswordNotification;
use App\Events\Models\Auth\ChangePassword;

class ChangePasswordSubscriber
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
            ChangePassword::class,
            ChangePasswordNotification::class, 
        );
      
    }
}