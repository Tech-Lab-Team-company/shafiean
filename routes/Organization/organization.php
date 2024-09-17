<?php

use App\Http\Controllers\Global\StageController;
use App\Http\Controllers\Organization\AuthController;
use App\Http\Controllers\Organization\CourseController;
use App\Http\Controllers\Organization\EmployeeController;
use App\Http\Controllers\Organization\TeacherAuthController;
use App\Http\Controllers\Organization\TeacherController;
use App\Http\Controllers\Organization\TermController;
use Illuminate\Support\Facades\Route;

// auth routes

Route::controller(AuthController::class)->group(function () {
    Route::post('organization-register', 'register');
    Route::post('organization-login', 'login');
    Route::post('organization-check-email', 'checkEmail');
    Route::post('organization-check-code', 'checkCode');
    Route::post('organization-reset-password', 'resetPassword');
});
// auth routes
Route::middleware('auth:organization')->group(function () {
    // auth routes
    Route::controller(AuthController::class)->group(function () {
        Route::post('organization-logout', 'logout');
        Route::post('organization-change-password', 'changePassword');
    });

    // Employee Routes
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('fetch_employees', 'fetch_employees');
        Route::post('add_employee', 'add_employee');
        Route::post('fetch_employee_details', 'fetch_employee_details');
        Route::post('edit_employee', 'update_employee');
        Route::post('delete_employee', 'delete_employee');
        Route::post('edit_employee_password', 'edit_employee_password');
    });

    // Course Routes

    Route::controller(CourseController::class)->group(function () {
        Route::post('fetch_courses', 'fetch_courses');
        Route::post('add_course', 'add_course');
        Route::post('fetch_course_details', 'fetch_course_details');
        Route::post('edit_course', 'edit_course');
        Route::post('delete_course', 'delete_course');
        Route::post('change_course_active_status', 'change_course_active_status');
        Route::post('add_course_stage', 'add_course_stage');
    });
});
// Teacher Routes
Route::prefix('teachers')->group(function () {

    Route::post('/', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/{id}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::put('/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});



// Term Routes
Route::prefix('terms')->group(function () {
    Route::get('/', [TermController::class, 'index'])->name('terms.index');
    Route::post('/', [TermController::class, 'store'])->name('terms.store');
    Route::get('/{id}', [TermController::class, 'show'])->name('terms.show');
    Route::put('/{id}', [TermController::class, 'update'])->name('terms.update');
    Route::delete('/{id}', [TermController::class, 'destroy'])->name('terms.destroy');
});
