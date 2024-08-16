<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User Routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});


Route::apiResource('countries', CountryController::class);
// Country Routes
Route::prefix('countries')->group(function () {
    Route::get('/', [CountryController::class, 'index'])->name('countries.index');
    Route::post('/', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/{id}', [CountryController::class, 'show'])->name('countries.show');
    Route::put('/{id}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');
});
