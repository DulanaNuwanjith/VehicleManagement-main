<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [
    \App\Http\Controllers\Dashboard::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('vehicles', \App\Http\Controllers\VehicleController::class);
    Route::resource('services', \App\Http\Controllers\ServiceController::class);
    Route::resource('maintainances', \App\Http\Controllers\MaintainanceController::class);
    Route::resource('meterreads', \App\Http\Controllers\MeterReadController::class);
    Route::resource('travelrecords', \App\Http\Controllers\TravelRecordController::class);
});

require __DIR__.'/auth.php';
