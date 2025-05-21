<?php

namespace App\Listeners\Models\Auth;

use App\Events\Models\Auth\UpdateProfile;
use App\Mail\UpdateProfileMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProfileNotification
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
     * @param  UpdateProfile  $event
     * @return void
     */
    public function handle(UpdateProfile $event)
    {
         Mail::to($event->user)->send(new UpdateProfileMail($event->user));
    }
}
