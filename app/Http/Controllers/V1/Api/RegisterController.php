<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Notifications\Auth\RegisterNotification;
use Carbon\Carbon;
use App\Events\Models\Auth\UserRegister;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller implements ShouldQueue
{
      public function register(Request $request)
    {

        $users = User::first();

        $user = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required' 
        ]);

        $user = User::create([
            'name' => $request->name,
            'active' => true,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $when = Carbon::now()->addSeconds(10);

        $user->notify((new RegisterNotification($user))->delay($when));

         event(new UserRegister($user));

         event(new Registered($user));

        $token  = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response, 201);
    }
}
