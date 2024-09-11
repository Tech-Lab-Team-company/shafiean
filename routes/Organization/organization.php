<?php

use App\Http\Controllers\Global\StageController;
use App\Http\Controllers\Organization\AuthController;
use App\Http\Controllers\Organization\EmployeeController;
use App\Http\Controllers\Organization\TeacherAuthController;
use App\Http\Controllers\Organization\TeacherController;
use App\Http\Controllers\Organization\TermController;
use Illuminate\Support\Facades\Route;

Route::post('organization-login', [AuthController::class, 'login']);
Route::post('organization-check-email', [AuthController::class, 'checkEmail']);
Route::post('organization-check-code', [AuthController::class, 'checkCode']);
Route::post('organization-reset-password', [AuthController::class, 'resetPassword']);
Route::middleware('auth:organization')->group(function () {
    Route::post('organization-logout', [AuthController::class, 'logout']);
    Route::post('organization-change-password', [AuthController::class, 'changePassword']);
    Route::post('add_employee', [EmployeeController::class, 'add_employee']);
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
