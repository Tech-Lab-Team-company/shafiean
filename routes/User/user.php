<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserRegisterController;



// AUTH
Route::post('user_register', UserRegisterController::class);
Route::post('user_login', UserLoginController::class);

Route::middleware('auth:user')->group(function () {

    
});
