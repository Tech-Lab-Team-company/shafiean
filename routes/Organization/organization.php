<?php


use Illuminate\Support\Facades\Route;

Route::get('/organization', function (){
    return  'organization';
})->name('organization.index');
