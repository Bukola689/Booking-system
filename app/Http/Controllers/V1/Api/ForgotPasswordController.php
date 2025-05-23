<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\PasswordReset;
use App\Models\User;
use App\Events\Models\Auth\ForgotPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use App\Notifications\Auth\ForgotPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller implements ShouldQueue
{
       public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string'
        ]);
        
        if (! $user = User::firstWhere(['email' => $request->email])) {
            return "Email does not exist.";
        }

        $reset = PasswordReset::createToken($request->email);

         $when = Carbon::now()->addSeconds(10);

        $user->notify((new forgotPasswordNotification($user))->delay($when));

         Mail::to($request->email)->send((new PasswordResetMail($user, $reset)));

        return "Reset password link has been sent to your email.";

    }
}
