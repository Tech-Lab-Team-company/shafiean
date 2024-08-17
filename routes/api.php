<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DisabilityTypeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHistoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





Route::apiResource('admins', AdminController::class);
Route::apiResource('admin_histories', AdminHistoryController::class);
Route::apiResource('disability_types', DisabilityTypeController::class);

// User Routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

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
