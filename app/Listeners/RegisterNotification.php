<?php

namespace App\Listeners;

use App\Events\UserRegister;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;

class RegisterNotification
{
    private $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
         Mail::to($event->user)->send(new RegisteredMail($event->user));
    }
}
