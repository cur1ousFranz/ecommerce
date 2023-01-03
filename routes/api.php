<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/signout', [UserController::class, 'delete']);
    Route::get('/product/category', [CategoryController::class, 'index']);
    Route::get('/product/category/{category}', [CategoryController::class, 'show']);
    Route::get('/product/category/{category}/attribute', [CategoryController::class, 'showAttribute']);
});

// GUEST - CUSTOMER / ADMIN END
Route::post('/signin', [UserController::class, 'show']);
Route::post('/admin/signin', [UserController::class, 'showAdmin']);
Route::post('/signup', [UserController::class, 'store']);
Route::post('/signup/verify', [UserController::class, 'verifyEmail']);
Route::post('/signup/verify/resend', [UserController::class, 'resendVerifyEmail']);
Route::post('/reset', [UserController::class, 'update']);
Route::post('/reset/password', [UserController::class, 'updatePassword']);



