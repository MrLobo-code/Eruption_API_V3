<?php

use Illuminate\Support\Facades\Route;

Route::post('/test1', [App\Http\Controllers\paymentController::class, 'test1']);
Route::post('/create-checkout-session', [App\Http\Controllers\paymentController::class, 'payment']);
