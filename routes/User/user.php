<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserLogoutController;
use App\Http\Controllers\User\Auth\UserRegisterController;

use App\Http\Controllers\User\Competition\CompetitionController;
use App\Http\Controllers\User\Course\CourseController;

use App\Http\Controllers\User\Auth\UserResetPasswordController;




// AUTH
Route::post('user_register', UserRegisterController::class);
Route::post('user_login', UserLoginController::class);

Route::middleware('auth:user')->group(function () {

    Route::post('user_fetch_competitions', [CompetitionController::class, 'fetch_competitions']);
    Route::post('user_fetch_courses', [CourseController::class, 'fetch_courses']);

    // AUTH
    Route::post('user_logout', UserLogoutController::class);
    Route::post('user_reset_password', UserResetPasswordController::class);

});
