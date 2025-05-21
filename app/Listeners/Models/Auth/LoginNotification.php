<?php

namespace App\Listeners\Models\Auth;

use App\Events\Models\Auth\UserLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use Illuminate\Queue\InteractsWithQueue;

class LoginNotification
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
     * @param  UserLogin  $event
     * @return void
     */
    public function handle(UserLogin $event)
    {

        Mail::to($event->user)->send(new LoginMail($event->user));
    }
}
