<?php

namespace App\Listeners\Models\Auth;

use App\Events\Models\Auth\UserRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Queue\InteractsWithQueue;

class RegisterNotification
{
    
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
         Mail::to($event->user)->send(new WelcomeMail($event->user));

        //$event->user->notify(new WelcomeNotification());
    }
}
