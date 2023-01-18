<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\CustomerCategoryAttributeController;
use App\Http\Controllers\CustomerCategoryController;
use App\Http\Controllers\CustomerCategoryProductController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/signout', [UserController::class, 'delete']);

    // ADMIN
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category','index');
        Route::get('/category/{category}', 'show');
        Route::get('/category/{category}/attribute', 'showAttribute');
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/product', 'index');
        Route::post('/product', 'store');
        Route::get('/product/{product}', 'show');
        Route::put('/product/{product}', 'update');
        Route::delete('/product/{product}', 'destroy');
        Route::post('/product/search', 'search');
    });

    Route::post('/attribute', [AttributeValueController::class, 'store']);

});

// CUSTOMER
Route::controller(CustomerCategoryController::class)->group(function(){
    Route::get('/customer/category/women', 'womenIndex');
    Route::get('/customer/category/men', 'menIndex');
    Route::get('/customer/category/kids', 'kidsIndex');
    // Route::get('/category/{category:slug}', 'show');
});

Route::controller(CustomerCategoryProductController::class)->group(function(){
    Route::get('/customer/category/{category:slug}/product', 'show');
});

Route::controller(CustomerCategoryAttributeController::class)->group(function(){
    Route::get('/customer/category/{category:slug}/attribute', 'show');
});

// GUEST - CUSTOMER / ADMIN END
Route::controller(UserController::class)->group(function(){
    Route::post('/signin','show');
    Route::post('/admin/signin', 'showAdmin');
    Route::post('/signup', 'store');
    Route::post('/signup/verify', 'verifyEmail');
    Route::post('/signup/verify/resend', 'resendVerifyEmail');
    Route::post('/reset', 'update');
    Route::post('/reset/password','updatePassword');
});




