<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHistoryController;
use App\Http\Controllers\Admin\AyatController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\DisabilityTypeController;
use App\Http\Controllers\Admin\QuraanController;
use App\Http\Controllers\Organization\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('check-email', [AdminAuthController::class, 'checkEmail']);
    Route::post('check-code', [AdminAuthController::class, 'checkCode']);
    Route::post('reset-password', [AdminAuthController::class, 'resetPassword']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::post('/change-password', [AdminAuthController::class, 'changePassword']);
    });
    // Admin Routes
    Route::prefix('admins')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admins.index');
        Route::post('/', [AdminController::class, 'store'])->name('admins.store');
        Route::post('/show', [AdminController::class, 'show'])->name('admins.show');
        Route::post('/update', [AdminController::class, 'update'])->name('admins.update');
        Route::post('/destroy', [AdminController::class, 'destroy'])->name('admins.destroy');
        Route::post('/edit-password', [AdminController::class, 'EditPassword']);
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
        Route::post('/', [DisabilityTypeController::class, 'index'])->name('disability_types.index');
        Route::post('/store', [DisabilityTypeController::class, 'store'])->name('disability_types.store');
        Route::post('/show', [DisabilityTypeController::class, 'show'])->name('disability_types.show');
        Route::post('/update', [DisabilityTypeController::class, 'update'])->name('disability_types.update');
        Route::post('/destroy', [DisabilityTypeController::class, 'destroy'])->name('disability_types.destroy');
    });

    // Organization Routes
    Route::prefix('organizations')->group(function () {
        Route::post('/', [OrganizationController::class, 'index'])->name('organizations.index');
        Route::post('/store', [OrganizationController::class, 'store'])->name('organizations.store');
        Route::post('/show', [OrganizationController::class, 'show'])->name('organizations.show');
        Route::post('/update', [OrganizationController::class, 'update'])->name('organizations.update');
        Route::post('/destroy', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
    });

    // Curriculum Routes
    Route::prefix('curriculums')->group(function () {
        Route::get('/', [CurriculumController::class, 'index'])->name('curriculums.index');
        Route::post('/', [CurriculumController::class, 'store'])->name('curriculums.store');
        Route::get('/{id}', [CurriculumController::class, 'show'])->name('curriculums.show');
        Route::put('/{id}', [CurriculumController::class, 'update'])->name('curriculums.update');
        Route::delete('/{id}', [CurriculumController::class, 'destroy'])->name('curriculums.destroy');
    });

    Route::resource('ayat', AyatController::class);
    Route::resource('quraan', QuraanController::class);
});
