<?php

use App\Http\Controllers\User\Session\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user')->group(function () {
    Route::controller(SessionController::class)->group(function () {
        Route::post('fetch-student-sessions', 'fetch_student_sessions');
    });
});
