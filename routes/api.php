<?php

use Illuminate\Support\Facades\Route;

Route::post('/test1', [App\Http\Controllers\paymentController::class, 'test1']);
Route::post('/create-checkout-session', [App\Http\Controllers\paymentController::class, 'payment']);

Route::post('/login', [App\Http\Controllers\usersController::class, 'userAuth']);
Route::post('/signup', [App\Http\Controllers\usersController::class, 'createUser']);
Route::get('/validateToken', App\Http\Controllers\validateTokenController::class);

