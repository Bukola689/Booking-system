<?php

namespace App\Http\Controllers\V1\Api\Auth;

use App\Http\Controllers\Controller;
use App\Events\Profile\ProfileCreated;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Notifications\PasswordNotification;
use App\Notifications\ProfileNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;

class updateProfileController extends Controller
{
      public function updateProfile(Request $request)
    {

        //$user = User::first();

        $profile = $request->user();

        $data = Validator::make($request->all(),[
            'name' => 'required',
        ]);

       // dd($data);
  
        if($data->fails()) {
            return response()->json([
                'message'=> 'please check your credentials fillable and try again'
            ]);

        }

        $profile->name = $request->input('name');
        $profile->update();

       // $user->verify(new ProfileNotification($user));

      //  event(new ProfileCreated($profile));

        Cache::put('user', $data);

       // return new UserResource($profile);

       return response()->json(['message' => 'successfully']);
    }

    public function changePassword(Request $request)
    {
        //$profile = User::first();

        $validator = Validator::make($request->all(), [
            "old_password" => "required",
            "password" => "required|min:8|different:old_password",
            "confirm_password" => "required|same:password"
       ]);

       if($validator->fails()) {
        return response()->json(['message'=> 'check your password and try again']);
       }
    
           $profile = $request->user();

    
            if( Hash::check($request->old_password, $profile->password)){
               
                $profile->update([
                    'password' => Hash::make($request->password)
                ]);

              // $user->verify(new PasswordNotification($user));

              // Cache::put('user', $data);
    
               return response()->json([
                  'message'=> 'Password Updated Successfully',
               ], 200);
    
            } else {
                return response()->json([
                    'message' => 'old password does no match !'
                ], 401);
             }
    }
}
