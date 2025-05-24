<?php

namespace App\Http\Controllers\V1\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
    {

        $users = User::orderBy('id', 'desc')->paginate(5);
        
         if($users->isEmpty()) {
            throw new NotFoundHttpException('User is Empty');
        }

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:15',
            'email' => 'required|string|email',
            'role' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'error message' => 'invalid credentials'
            ]);

        }

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->active = true;
            $user->role = $request->input('role');
            $user->password = Hash::make($request->password);
            $user->save();
      

          return response()->json([
            'success' => 'User Created Successfully',
            'user' => $user
          ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        if(! $user) {

           return response()->json('User not found');
         }

        return response()->json($user);
    }

    public function update(Request $request, $id)
     {
        $user = User::find($id);

        if(! $user) {
            throw new NotFoundHttpException('User Not found');
         }
 
         $validator = Validator::make($request->all(), [
             'name' => 'required|string|min:3|max:15',
         ]);
 
         if($validator->fails()) {
             return response()->json([
                 'error message' => 'invalid credentials'
             ]);

         }
 
             $user->name = $request->name;
             $user->update();
       
 
           return response()->json([
             'success' => 'User Created Successfully'
           ]);
     }

     public function destroy($id)
     {
        $user = User::find($id);

        if(! $user) {
            return response()->json('user not found');
         }

         $user->delete();

         return response()->json('User  Succesfully Removed !');
     }

     public function suspend($id)
     {
        $user = User::find($id);

        if(! $user) {
            throw new NotFoundHttpException('user not found');
         }

         $user->active = false;
         $user->save();

         return response()->json([
            'message' => 'User Suspended Successfully'
         ]);
     }

     public function active($id)
     {

        $user = User::find($id);

        if(! $user) {
            throw new NotFoundHttpException('user not found');
         }

         $user->active = true;
         $user->save();

         return response()->json([
            'message' => 'User Been Active Successfully'
         ]);
     }
}
