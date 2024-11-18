<?php

use App\Http\Controllers\Parent\Child\ChildController;
use App\Http\Controllers\User\Session\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user')->group(function () {
    Route::controller(SessionController::class)->group(function () {
        Route::post('fetch_student_sessions', 'fetch_student_sessions');
    });

    Route::controller(ChildController::class)->group(function () {
        Route::post('academic_report', 'academic_report');
    });
});
