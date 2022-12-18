<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::group(['middleware' => 'cors'], function () {
//     Route::get('/auth/google', [LoginController::class, 'googleAuth']);
//     Route::get('/auth/google/callback', [LoginController::class, 'googleAuthCallBack']);
// });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

Route::post('/signup', [SignupController::class, 'store']);
Route::post('/signup/verify', [SignupController::class, 'verifyEmail']);
Route::post('/signup/verify/resend', [SignupController::class, 'resendVerifyEmail']);



