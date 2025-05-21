<?php

namespace App\Listeners\Models\Auth;

use App\Events\Models\Auth\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\PasswordReset;
use App\Mail\PasswordResetMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ForgotPasswordNotification implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user, PasswordReset $reset)
    {
       //
    }

    /**
     * Handle the event.
     *
     * @param  ForgotPassword  $event
     * @return void
     */
    public function handle(ForgotPassword $event)
    {
       
    }
}
