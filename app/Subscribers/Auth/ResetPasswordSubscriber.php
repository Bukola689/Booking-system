<?php

namespace App\Subscribers\Auth;
use Illuminate\Events\Dispatcher;
use App\Listeners\Models\Auth\ResetPasswordNotification;
use App\Events\Models\Auth\ResetPassword;

class ResetPasswordSubscriber
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
            ResetPassword::class,
            ResetPasswordNotification::class, 
        );
      
    }
}