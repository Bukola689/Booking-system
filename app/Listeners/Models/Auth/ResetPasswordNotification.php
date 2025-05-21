<?php

namespace App\Listeners\Models\Auth;

use App\Events\Models\Auth\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Queue\InteractsWithQueue;

class ResetPasswordNotification
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
     * @param  ResetPassword  $event
     * @return void
     */
    public function handle(ResetPassword $event)
    {
         Mail::to($event->user)->send(new ResetPasswordMail($event->user));
    }
}
