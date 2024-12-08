<?php

use App\Http\Controllers\Parent\Child\ChildController;
use App\Http\Controllers\User\Session\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:user')->group(function () {
    Route::controller(SessionController::class)->group(function () {
        Route::post('fetch_child_sessions', 'fetch_child_sessions');
    });

    Route::controller(ChildController::class)->group(function () {
        Route::post('academic_report', 'academic_report');
        Route::post('exam_report', 'exam_report');
        Route::post('little_exam_report', 'littleExamReport');
        Route::post('session_attendance_report', 'session_attendance_report');
        Route::post('parent_children', 'parentChildren');
        Route::post('parent_child_details', 'parentChildDetails');
        Route::post('competition_report', 'competitionReport');
    });
});
