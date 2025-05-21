<?php

namespace App\Subscribers\Auth;
use Illuminate\Events\Dispatcher;
use App\Listeners\Models\Auth\Notification;
use App\Events\Models\Auth\UpdateProfile;
use App\Listeners\Models\Auth\UpdateProfileNotification;

class UpdateProfileSubscriber
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
            UpdateProfile::class,
            UpdateProfileNotification::class,
        );
      
    }
}