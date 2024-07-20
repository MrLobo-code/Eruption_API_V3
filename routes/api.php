<?php

use Illuminate\Support\Facades\Route;

Route::post('/test1', [App\Http\Controllers\paymentController::class, 'test1']);
Route::post('/create-checkout-session', [App\Http\Controllers\paymentController::class, 'payment']);
Route::post('/login', [App\Http\Controllers\usersController::class, 'userAuth']);
Route::post('/signup', [App\Http\Controllers\usersController::class, 'createUser']);
Route::post('/addToCart', [App\Http\Controllers\usersController::class, 'addToCart']);
Route::post('/cartProductCounter', [App\Http\Controllers\usersController::class, 'cartProductCounter']);
Route::get('/validateToken', App\Http\Controllers\validateTokenController::class);
Route::get('/users', [App\Http\Controllers\usersController::class, 'getUsers']);
Route::get('/products', [App\Http\Controllers\ProductController::class, 'getProduct']);
