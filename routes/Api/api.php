<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Global\CityController;
use App\Http\Controllers\Global\CountryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('user/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
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

Route::post('fetch_countries', [CountryController::class, 'index'])->name('countries.index');
Route::post('add_country', [CountryController::class, 'store'])->name('countries.store');
Route::post('fetch_country_details', [CountryController::class, 'show'])->name('countries.show');
Route::post('edit_country', [CountryController::class, 'update'])->name('countries.update');
Route::post('delete_country', [CountryController::class, 'destroy'])->name('countries.destroy');


// City Routes

Route::post('fetch_cities', [CityController::class, 'index'])->name('cities.index');
Route::post('add_city', [CityController::class, 'store'])->name('cities.store');
Route::post('fetch_city_details', [CityController::class, 'show'])->name('cities.show');
Route::post('edit_city', [CityController::class, 'update'])->name('cities.update');
Route::post('delete_city', [CityController::class, 'destroy'])->name('cities.destroy');
