<?php

use App\Http\Controllers\AttributeValueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/signout', [UserController::class, 'delete']);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{category}', [CategoryController::class, 'show']);
    Route::get('/category/{category}/attribute', [CategoryController::class, 'showAttribute']);

    Route::post('/attribute', [AttributeValueController::class, 'store']);

    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{product}', [ProductController::class, 'show']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::delete('/product/{product}', [ProductController::class, 'destroy']);

});

// GUEST - CUSTOMER / ADMIN END
Route::post('/signin', [UserController::class, 'show']);
Route::post('/admin/signin', [UserController::class, 'showAdmin']);
Route::post('/signup', [UserController::class, 'store']);
Route::post('/signup/verify', [UserController::class, 'verifyEmail']);
Route::post('/signup/verify/resend', [UserController::class, 'resendVerifyEmail']);
Route::post('/reset', [UserController::class, 'update']);
Route::post('/reset/password', [UserController::class, 'updatePassword']);



