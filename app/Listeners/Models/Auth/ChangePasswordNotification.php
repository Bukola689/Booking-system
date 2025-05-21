<?php

namespace App\Listeners\Models\Auth;

use App\Events\Models\Auth\ChangePassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\ChangePasswordMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangePasswordNotification
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
     * @param  ChangePassword  $event
     * @return void
     */
    public function handle(ChangePassword $event)
    {
        Mail::to($event->user)->send(new ChangePasswordMail($event->user));
    }
}
