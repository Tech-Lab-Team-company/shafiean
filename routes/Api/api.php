<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Global\CityController;
use App\Http\Controllers\Global\CountryController;
use Illuminate\Support\Facades\Route;


Route::post('user/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user/logout', [AuthController::class, 'logout']);
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
