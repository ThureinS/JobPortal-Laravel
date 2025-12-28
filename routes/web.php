<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;


Route::get('', fn() => to_route('job-posts.index'));
Route::resource('job-posts', JobPostController::class)
    ->only(['index', 'show']);


Route::get('login', fn() => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);
