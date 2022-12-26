<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/signout', [UserController::class, 'delete']);
});

Route::post('/signin', [UserController::class, 'show']);
Route::post('/signup', [UserController::class, 'store']);
Route::post('/signup/verify', [UserController::class, 'verifyEmail']);
Route::post('/signup/verify/resend', [UserController::class, 'resendVerifyEmail']);
Route::post('/reset', [UserController::class, 'update']);
Route::post('/reset/password', [UserController::class, 'updatePassword']);



