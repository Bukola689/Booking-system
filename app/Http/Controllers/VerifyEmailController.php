<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
     public function verify($id, $hash)
    {
        $user = User::find($id);

        abort_if(!$user, 403);

        abort_if(!hash_equals($hash, sha1($user->getEmailForVerification())), 403);

        if(!$user->hasVerifiedEmail()) {

            $user->markEmailAsVerified();

            event(new Verified($user));
        }

        return view('emails.verified-account');
    }

    public function resendNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return  response()->json([
            'message' => 'An Email Verification Has Been Resent To You !'
        ]);
    }
}
