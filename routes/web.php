<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(CarController::class)->group(function() {
    Route::get('/cars', 'index')->name('car.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/api/list-mobil', function (Request $request) {
    $merk = $request->query('merk'); // atau $request->merk

    $data = [
        ['nama' => 'asep'],
        'merk' => $merk,
    ];

    return $data;
});

require __DIR__.'/auth.php';
