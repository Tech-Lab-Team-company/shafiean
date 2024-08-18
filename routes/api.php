<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TermController;
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

// Admin Routes
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admins.index');
    Route::post('/', [AdminController::class, 'store'])->name('admins.store');
    Route::get('/{id}', [AdminController::class, 'show'])->name('admins.show');
    Route::put('/{id}', [AdminController::class, 'update'])->name('admins.update');
    Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
});

// Admin History Routes
Route::prefix('admin_histories')->group(function () {
    Route::get('/', [AdminHistoryController::class, 'index'])->name('admin_histories.index');
    Route::post('/', [AdminHistoryController::class, 'store'])->name('admin_histories.store');
    Route::get('/{id}', [AdminHistoryController::class, 'show'])->name('admin_histories.show');
    Route::put('/{id}', [AdminHistoryController::class, 'update'])->name('admin_histories.update');
    Route::delete('/{id}', [AdminHistoryController::class, 'destroy'])->name('admin_histories.destroy');
});

// Disability_types Routes
Route::prefix('disability_types')->group(function () {
    Route::get('/', [DisabilityTypeController::class, 'index'])->name('disability_types.index');
    Route::post('/', [DisabilityTypeController::class, 'store'])->name('disability_types.store');
    Route::get('/{id}', [DisabilityTypeController::class, 'show'])->name('disability_types.show');
    Route::put('/{id}', [DisabilityTypeController::class, 'update'])->name('disability_types.update');
    Route::delete('/{id}', [DisabilityTypeController::class, 'destroy'])->name('disability_types.destroy');
});

// Curriculum Routes
Route::prefix('curriculums')->group(function () {
    Route::get('/', [CurriculumController::class, 'index'])->name('curriculums.index');
    Route::post('/', [CurriculumController::class, 'store'])->name('curriculums.store');
    Route::get('/{id}', [CurriculumController::class, 'show'])->name('curriculums.show');
    Route::put('/{id}', [CurriculumController::class, 'update'])->name('curriculums.update');
    Route::delete('/{id}', [CurriculumController::class, 'destroy'])->name('curriculums.destroy');
});

// Organization Routes
Route::prefix('organizations')->group(function () {
    Route::get('/', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::post('/', [OrganizationController::class, 'store'])->name('organizations.store');
    Route::get('/{id}', [OrganizationController::class, 'show'])->name('organizations.show');
    Route::put('/{id}', [OrganizationController::class, 'update'])->name('organizations.update');
    Route::delete('/{id}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
});

// Teacher Routes
Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/{id}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::put('/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});

// Stage Routes
Route::prefix('stages')->group(function () {
    Route::get('/', [StageController::class, 'index'])->name('stages.index');
    Route::post('/', [StageController::class, 'store'])->name('stages.store');
    Route::get('/{id}', [StageController::class, 'show'])->name('stages.show');
    Route::put('/{id}', [StageController::class, 'update'])->name('stages.update');
    Route::delete('/{id}', [StageController::class, 'destroy'])->name('stages.destroy');
});

// Term Routes
Route::prefix('terms')->group(function () {
    Route::get('/', [TermController::class, 'index'])->name('terms.index');
    Route::post('/', [TermController::class, 'store'])->name('terms.store');
    Route::get('/{id}', [TermController::class, 'show'])->name('terms.show');
    Route::put('/{id}', [TermController::class, 'update'])->name('terms.update');
    Route::delete('/{id}', [TermController::class, 'destroy'])->name('terms.destroy');
});

