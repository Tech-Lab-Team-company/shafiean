<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Group\GroupController;
use App\Http\Controllers\User\Stage\StageController;
use App\Http\Controllers\User\Course\CourseController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserLogoutController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Auth\UserCheckCodeController;
use App\Http\Controllers\User\Auth\UserResetPasswordController;
use App\Http\Controllers\User\Auth\UserChangePasswordController;
use App\Http\Controllers\User\Competition\CompetitionController;
use App\Http\Controllers\User\Session\SessionController;

// AUTH
Route::post('user_register', UserRegisterController::class);
Route::post('user_login', UserLoginController::class);
Route::post('user_change_password', UserChangePasswordController::class);
Route::post('user_check_code', UserCheckCodeController::class);

Route::middleware('auth:user')->group(function () {

    // AUTH
    Route::post('user_logout', UserLogoutController::class);
    Route::post('user_reset_password', UserResetPasswordController::class);

    /**
     * END POINT START
     */
    Route::post('user_fetch_competitions', [CompetitionController::class, 'fetch_competitions']);
    Route::post('user_fetch_courses', [CourseController::class, 'fetch_courses']);
    Route::post('user_fetch_groups', [GroupController::class, 'fetch_groups']);
    Route::post('user_fetch_stages', [StageController::class, 'fetch_stages']);
    Route::post('user_fetch_sessions', [SessionController::class, 'fetch_sessions']);
    /**
     * END POINT END
     */
});
