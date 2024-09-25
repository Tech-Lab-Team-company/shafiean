<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Global\GlobalController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Organization\Auth\AuthController;
use App\Http\Controllers\Organization\Term\TermController;
use App\Http\Controllers\Organization\User\UserController;
use App\Http\Controllers\Organization\Group\GroupController;
use App\Http\Controllers\Organization\Course\CourseController;
use App\Http\Controllers\Organization\Teacher\TeacherController;
use App\Http\Controllers\Organization\Employee\EmployeeController;
use App\Http\Controllers\Organization\Relation\RelationController;
use App\Http\Controllers\Organization\UserRelation\UserRelationController;


Route::middleware('auth:organization')->group(function () {
    //USER RELATION
    Route::controller(UserRelationController::class)->group(function () {
        Route::post('fetch_user_relations', 'index');
        Route::post('add_user_relation', 'store');
        Route::post('fetch_user_relation_details', 'show');
        Route::post('edit_user_relation', 'update');
        Route::post('delete_user_relation', 'delete');
    });
    //RELATION
    Route::controller(RelationController::class)->group(function () {
        Route::post('fetch_relations', 'index');
        Route::post('add_relation', 'store');
        Route::post('fetch_relation_details', 'show');
        Route::post('edit_relation', 'update');
        Route::post('delete_relation', 'delete');
    });
    //USER
    Route::controller(UserController::class)->group(function () {
        Route::post('fetch_users', 'index');
        Route::post('add_user', 'store');
        Route::post('fetch_user_details', 'show');
        Route::post('edit_user', 'update');
        Route::post('delete_user', 'delete');
    });

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
    Route::controller(GroupController::class)->group(function () {
        Route::post('fetch_groups', 'fetch_groups');
        Route::post('add_group', 'add_group');
        Route::post('fetch_group_details', 'fetch_group_details');
        Route::post('edit_group', 'edit_group');
        Route::post('delete_group', 'delete_group');
        Route::post('change_group_active_status', 'change_group_active_status');
    });
    Route::controller(CurriculumController::class)->group(function () {
        Route::post('organization_fetch_curriculums',  'index');
    });
});
// auth routes
Route::controller(AuthController::class)->group(function () {
    Route::post('organization-register', 'register');
    Route::post('organization-login', 'login');
    Route::post('organization-check-email', 'checkEmail');
    Route::post('organization-check-code', 'checkCode');
    Route::post('organization-reset-password', 'resetPassword');
});
// global routes
Route::controller(GlobalController::class)->group(function () {
    Route::post('fetch_days',  'fetch_days');
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
