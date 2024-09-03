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

    Route::post('fetch_disabilities', [DisabilityTypeController::class, 'index'])->name('disability_types.index');
    Route::post('add_disability', [DisabilityTypeController::class, 'store'])->name('disability_types.store');
    Route::post('fetch_disability_details', [DisabilityTypeController::class, 'show'])->name('disability_types.show');
    Route::post('edit_disability', [DisabilityTypeController::class, 'update'])->name('disability_types.update');
    Route::post('delete_disability', [DisabilityTypeController::class, 'destroy'])->name('disability_types.destroy');


    // Organization Routes

    Route::post('fetch_organizations', [OrganizationController::class, 'index'])->name('organizations.index');
    Route::post('add_organization', [OrganizationController::class, 'store'])->name('organizations.store');
    Route::post('fetch_organization_details', [OrganizationController::class, 'show'])->name('organizations.show');
    Route::post('edit_organization', [OrganizationController::class, 'update'])->name('organizations.update');
    Route::post('delete_organization', [OrganizationController::class, 'destroy'])->name('organizations.destroy');


    // Curriculum Routes

    Route::post('fetch_curriculums', [CurriculumController::class, 'index'])->name('curriculums.index');
    Route::post('fetch_curriculum_details', [CurriculumController::class, 'show'])->name('curriculums.show');
    Route::post('add_curriculum', [CurriculumController::class, 'store'])->name('curriculums.store');
    Route::post('edit_curriculum', [CurriculumController::class, 'update'])->name('curriculums.update');
    Route::post('delete_curriculm', [CurriculumController::class, 'destroy'])->name('curriculums.destroy');
    Route::post('change_cirruclum_active_status', [CurriculumController::class, 'changeActiveStatus'])->name('curriculums.change_active_status');


    Route::resource('ayat', AyatController::class);
    Route::resource('quraan', QuraanController::class);
});
