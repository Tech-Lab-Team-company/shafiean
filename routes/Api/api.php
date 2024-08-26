<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Global\CityController;
use App\Http\Controllers\Global\CountryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('user/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('user/logout', [AuthController::class, 'logout']);

});


// User Routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
//
// Country Routes
Route::prefix('countries')->group(function () {
    Route::get('/', [CountryController::class, 'index'])->name('countries.index');
    Route::post('/', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/{id}', [CountryController::class, 'show'])->name('countries.show');
    Route::put('/{id}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');
});

// City Routes
Route::prefix('cities')->group(function () {
    Route::get('/', [CityController::class, 'index'])->name('cities.index');
    Route::post('/', [CityController::class, 'store'])->name('cities.store');
    Route::get('/{id}', [CityController::class, 'show'])->name('cities.show');
    Route::put('/{id}', [CityController::class, 'update'])->name('cities.update');
    Route::delete('/{id}', [CityController::class, 'destroy'])->name('cities.destroy');
});


