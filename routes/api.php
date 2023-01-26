<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\CustomerCartController;
use App\Http\Controllers\CustomerCategoryAttributeController;
use App\Http\Controllers\CustomerCategoryController;
use App\Http\Controllers\CustomerCategoryProductController;
use App\Http\Controllers\CustomerProductController;

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

    Route::controller(CustomerCartController::class)->group(function(){
        Route::get('/customer/cart', 'index');
        Route::post('/customer/cart', 'store');
        Route::put('/customer/cart/product/{product}', 'update');
        Route::put('/customer/cart/product/{product}/checkout', 'updateCheckout');
        Route::delete('/customer/cart/product/{product}', 'destroy');
    });

});

// CUSTOMER
Route::controller(CustomerCategoryController::class)->group(function(){
    Route::get('/customer/category/women', 'womenIndex');
    Route::get('/customer/category/men', 'menIndex');
    Route::get('/customer/category/kids', 'kidsIndex');
});

Route::controller(CustomerCategoryProductController::class)->group(function(){
    Route::get('/customer/category/{category:slug}/product', 'show');
    Route::get('/customer/category/product', 'index');
    Route::post('/customer/category/product/search', 'search');
});

Route::controller(CustomerCategoryAttributeController::class)->group(function(){
    Route::get('/customer/category/{category:slug}/attribute', 'show');
});

Route::controller(CustomerProductController::class)->group(function(){
    Route::get('/customer/product/all', 'index');
    Route::get('/customer/product', 'show');
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




