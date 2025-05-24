<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/register', [RegisteredUserController::class, 'registerApi']);
Route::post('/login', [AuthenticatedSessionController::class, 'loginApi']);

Route::controller(CarController::class)->group(function () {
    Route::get('/car/list', 'getCar');
    Route::post('/car/store', 'storeCarApi');
    Route::post('/car/delete', 'deleteCarApi');
    Route::post('/car/update', 'updateCarApi');
});

Route::controller(BookingController::class)->group(function () {
    Route::post('/booking/store', 'storeBookingApi');
    Route::get('/booking/{id?}', 'listBookingApi');
    Route::post('/booking/delete', 'deleteBookingApi');

    Route::post('/booking/pay', 'payBookingApi');
});