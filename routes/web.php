<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(CarController::class)->group(function () {
    Route::middleware(['auth', 'role.redirect'])->group(function () {
        Route::get('/cars', 'user')->name('car.user');
        Route::get('/cars-action', 'index')->name('car.index');
    });
    Route::post('/cars/store', 'addCar')->name('cars.store');
    Route::delete('/cars/delete/{id}', 'destroy')->name('cars.destroy');
    Route::get('/cars/edit/{id}', 'editCar')->name('cars.edit');
    Route::post('/cars/update/{id}', 'updateCar')->name('cars.update');
});

Route::controller(BookingController::class)->group(function () {
    Route::get('/cars/rent/{id}', 'index')->name('rent');
    Route::post('/cars/rent/store/{id}', 'storeBooking')->name('rent.store');
    Route::get('/booking-list', 'viewBooking')->name('booking.list');
    Route::delete('/booking-delete/{id}', 'deleteBooking')->name('booking.delete');

    Route::get('/report', 'viewReport')->name('report');
    Route::post('/booking-pay/{id}', 'payBooking')->name('pay.booking');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
