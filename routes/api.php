<?php

use Illuminate\Support\Facades\Route;

Route::post('/test1', [App\Http\Controllers\paymentController::class, 'test1']);
Route::post('/create-checkout-session', [App\Http\Controllers\paymentController::class, 'payment']);
Route::post('/login', [App\Http\Controllers\usersController::class, 'userAuth']);
Route::post('/signup', [App\Http\Controllers\usersController::class, 'createUser']);
Route::post('/addToCart', [App\Http\Controllers\usersController::class, 'addToCart']);
Route::post('/cartProductCounter', [App\Http\Controllers\usersController::class, 'cartProductCounter']);
Route::post('/Cart', [App\Http\Controllers\usersController::class, 'getCartItems']);
Route::post('/deleteCartItem', [App\Http\Controllers\usersController::class, 'deleteCartItem']);
Route::post('/createNewProduct', [App\Http\Controllers\productController::class, 'createNewProduct']);

Route::post('/uploadImages', [App\Http\Controllers\productController::class, 'uploadImages']);
Route::post('/s3-url', [App\Http\Controllers\productController::class, 'uploadToBucketS3']);

Route::get('/validateToken', App\Http\Controllers\validateTokenController::class);
Route::get('/users', [App\Http\Controllers\usersController::class, 'getUsers']);
Route::get('/products', [App\Http\Controllers\productController::class, 'getProduct']);
Route::post('/prudct_exist', [App\Http\Controllers\productController::class, 'productExist']);
