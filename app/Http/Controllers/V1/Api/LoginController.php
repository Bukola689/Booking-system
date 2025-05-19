<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class LoginController extends Controller
{
      public function login(Request $request)
    {
        $user = User::first();

        $data = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

      $user = User::where('email', $data['email'])->first();

      if(!$user || !Hash::check($data['password'], $user->password))
      {
          return response(['message'=>'invalid credentials'], 401);
      } else {
        $token  = $user->createToken('myapptoken')->plainTextToken;

       // $when = Carbon::now()->addSeconds(10);

       // $user->notify((new RegisterNotification($user))->delay($when));

        event(new Registered($user));

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        //Cache::put('user');

        return response($response, 200);
      }
    }
}
