<?php

use Illuminate\Http\Request;
use App\Http\Controller\V1\Api\Admin\UserController;
use App\Http\Controller\V1\Api\Admin\BusinessController;
use App\Http\Controllers\V1\Api\LoginController;
use App\Http\Controllers\V1\Api\BookingController;
use App\Http\Controllers\V1\Api\ReviewController;
use App\Http\Controllers\V1\Api\ServiceController;
use App\Http\Controllers\V1\Api\Auth\UpdateProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\V1\Api\Auth\ResetPasswordController;
use App\Http\Controllers\V1\Api\VerifyEmailController;
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

       Route::group(['middleware' => 'admin', 'middleware' => 'auth:sanctum'], function() {
         Route::post('/profiles', [UpdateProfileController::class, 'updateProfile']);
         Route::post('/change-password', [UpdateProfileController::class, 'changePassword']);
     });  

        Route::get('users', [UserController::class, 'index']);
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::put('users/{id}', [UserController::class, 'update']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);
        Route::post('users/{id}/suspend', [UserController::class, 'suspend']);
        Route::post('users/{id}/active', [UserController::class, 'active']);

        Route::get('businesses', [BusinessController::class, 'index']);
        Route::post('businesses', [BusinessController::class, 'store']);
        Route::get('businesses/{business}', [BusinessController::class, 'show']);
        Route::put('businesses/{business}', [BusinessController::class, 'update']);
        Route::delete('businesses/{business}', [BusinessController::class, 'destroy']);

         Route::get('reviews', [BusinessController::class, 'index']);
        Route::post('reviews', [BusinessController::class, 'store']);
        Route::get('reviews/{review}', [BusinessController::class, 'show']);
        Route::put('reviews/{review}', [BusinessController::class, 'update']);
        Route::delete('reviews/{review}', [BusinessController::class, 'destroy']);
         Route::get('business_reviews', [BusinessController::class, 'business_review']);



    //....auth....//
        Route::group(['prefix'=> 'auth'], function() {
            Route::post('register', [RegisterController::class, 'register']);
            Route::post('login', [LoginController::class, 'login']);
            Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
         Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::post('logout', [LogoutController::class, 'logout']);
            Route::post('/email/verification-notification', [VerifyEmailController::class, 'resendNotification'])->name('verification.send');
            Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']); 

            Route::get('bookings', [BookingController::class, 'index']);
            Route::post('bookings', [BookingController::class, 'store']);
            Route::get('bookings/{booking}', [BookingController::class, 'show']);
            Route::put('bookings/{booking}', [BookingController::class, 'update']);
            Route::delete('bookings/{booking}', [BookingController::class, 'destroy']);

          });
     });

          
         Route::group(['middleware' => 'me', 'middleware' => 'auth:sanctum'], function() {
         Route::post('/profiles', [UpdateProfileController::class, 'updateProfile']);
         Route::post('/change-password', [UpdateProfileController::class, 'changePassword']);
     });     
