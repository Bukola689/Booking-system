<?php

use Illuminate\Http\Request;
use App\Http\Controllers\V1\Api\LoginController;
use App\Http\Controllers\V1\Api\RegisterController;
use App\Http\Controllers\V1\Api\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    //....auth....//
        Route::group(['prefix'=> 'auth'], function() {
            Route::post('register', [RegisterController::class, 'register']);
            Route::post('login', [LoginController::class, 'login']);
            Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
         Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::post('logout', [LogoutController::class, 'logout']);
            Route::post('/email/verification-notification', [VerifyEmailController::class, 'resendNotification'])->name('verification.send');
            Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']); 

          });
     });
