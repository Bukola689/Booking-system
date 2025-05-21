<?php

namespace App\Subscribers\Auth;
use Illuminate\Events\Dispatcher;
use App\Listeners\Models\Auth\ForgotPasswordNotification;
use App\Events\Models\Auth\ForgotPassword;

class ForgotPasswordSubscriber
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
            ForgotPassword::class,
            ForgotPasswordNotification::class, 
        );
      
    }
}