<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AyatController;
use App\Http\Controllers\Admin\YearController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QuraanController;
use App\Http\Controllers\Admin\SeasonController;
use App\Http\Controllers\Global\StageController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\MainSessionController;
use App\Http\Controllers\Admin\SessionTypeController;
use App\Http\Controllers\Admin\AdminHistoryController;
use App\Http\Controllers\Admin\DisabilityTypeController;
use App\Http\Controllers\Organization\Organization\OrganizationController;

Route::prefix('admin')->group(function () {
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('check-email', [AdminAuthController::class, 'checkEmail']);
    Route::post('check-code', [AdminAuthController::class, 'checkCode']);
    Route::post('reset-password', [AdminAuthController::class, 'resetPassword']);
});
Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::post('/change-password', [AdminAuthController::class, 'changePassword']);
    });
    // Admin Routes
    Route::prefix('admins')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::post('/', [AdminController::class, 'store']);
        Route::post('/show', [AdminController::class, 'show']);
        Route::post('/update', [AdminController::class, 'update']);
        Route::post('/destroy', [AdminController::class, 'destroy']);
        Route::post('/edit-password', [AdminController::class, 'EditPassword']);
    });

    // Admin History Routes
    Route::prefix('admin_histories')->group(function () {
        Route::get('/', [AdminHistoryController::class, 'index']);
        Route::post('/', [AdminHistoryController::class, 'store']);
        Route::get('/{id}', [AdminHistoryController::class, 'show']);
        Route::put('/{id}', [AdminHistoryController::class, 'update']);
        Route::delete('/{id}', [AdminHistoryController::class, 'destroy']);
    });

    // Disability_types Routes

    Route::post('fetch_disabilities', [DisabilityTypeController::class, 'index']);
    Route::post('add_disability', [DisabilityTypeController::class, 'store']);
    Route::post('fetch_disability_details', [DisabilityTypeController::class, 'show']);
    Route::post('edit_disability', [DisabilityTypeController::class, 'update']);
    Route::post('delete_disability', [DisabilityTypeController::class, 'destroy']);


    // Organization Routes

    Route::post('fetch_organizations', [OrganizationController::class, 'index']);
    Route::post('add_organization', [OrganizationController::class, 'store']);
    Route::post('fetch_organization_details', [OrganizationController::class, 'show']);
    Route::post('edit_organization', [OrganizationController::class, 'update']);
    Route::post('delete_organization', [OrganizationController::class, 'destroy']);


    // Curriculum Routes

    Route::post('fetch_curriculums', [CurriculumController::class, 'index']);
    Route::post('fetch_curriculum_details', [CurriculumController::class, 'show']);
    Route::post('add_curriculum', [CurriculumController::class, 'store']);
    Route::post('edit_curriculum', [CurriculumController::class, 'update']);
    Route::post('delete_curriculm', [CurriculumController::class, 'destroy']);
    Route::post('change_cirruclum_active_status', [CurriculumController::class, 'changeActiveStatus']);

    // Stages Routes
    Route::post('fetch_stages', [StageController::class, 'index']);
    Route::post('add_stage', [StageController::class, 'store']);
    Route::post('fetch_stage_details', [StageController::class, 'show']);
    Route::post('edit_stage', [StageController::class, 'update']);
    Route::post('delete_stage', [StageController::class, 'destroy']);
    Route::post('change_stage_active_status', [StageController::class, 'changeActiveStatus']);

    // main sessions Routes
    Route::controller(MainSessionController::class)->group(function () {
        Route::post('fetch_sessions', 'index');
        Route::post('add_session', 'store');
        Route::post('fetch_session_details', 'show');
        Route::post('edit_session', 'update');
        Route::post('delete_session', 'destroy');
        Route::post('change_session_active_status', 'changeActiveStatus');
    });

    Route::controller(SessionTypeController::class)->group(function () {
        Route::post('fetch_session_types', 'index');
        Route::post('add_session_type', 'store');
        Route::post('fetch_session_type_details', 'show');
        Route::post('edit_session_type', 'update');
        Route::post('delete_session_type', 'destroy');
        Route::post('change_session_type_active_status', 'changeActiveStatus');
    });

    Route::controller(YearController::class)->group(function () {
        Route::post('fetch_years', 'index');
        Route::post('add_year', 'store');
        Route::post('fetch_year_details', 'show');
        Route::post('edit_year', 'update');
        Route::post('delete_year', 'destroy');
        Route::post('change_year_active_status', 'changeActiveStatus');
    });

    Route::controller(SeasonController::class)->group(function () {
        Route::post('fetch_seasons', 'index');
        Route::post('add_season', 'store');
        Route::post('fetch_season_details', 'show');
        Route::post('edit_season', 'update');
        Route::post('delete_season', 'destroy');
        Route::post('change_season_active_status', 'changeActiveStatus');
    });


    Route::resource('ayat', AyatController::class);
    Route::resource('quraan', QuraanController::class);
});
