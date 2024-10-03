<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserLogoutController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\Auth\UserResetPasswordController;



// AUTH
Route::post('user_register', UserRegisterController::class);
Route::post('user_login', UserLoginController::class);

Route::middleware('auth:user')->group(function () {
    // AUTH
    Route::post('user_logout', UserLogoutController::class);
    Route::post('user_reset_password', UserResetPasswordController::class);
});
