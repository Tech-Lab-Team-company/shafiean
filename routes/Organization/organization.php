<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TermController;

// Teacher Routes
Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/{id}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::put('/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
});

// Stage Routes
Route::prefix('stages')->group(function () {
    Route::get('/', [StageController::class, 'index'])->name('stages.index');
    Route::post('/', [StageController::class, 'store'])->name('stages.store');
    Route::get('/{id}', [StageController::class, 'show'])->name('stages.show');
    Route::put('/{id}', [StageController::class, 'update'])->name('stages.update');
    Route::delete('/{id}', [StageController::class, 'destroy'])->name('stages.destroy');
});

// Term Routes
Route::prefix('terms')->group(function () {
    Route::get('/', [TermController::class, 'index'])->name('terms.index');
    Route::post('/', [TermController::class, 'store'])->name('terms.store');
    Route::get('/{id}', [TermController::class, 'show'])->name('terms.show');
    Route::put('/{id}', [TermController::class, 'update'])->name('terms.update');
    Route::delete('/{id}', [TermController::class, 'destroy'])->name('terms.destroy');
});
