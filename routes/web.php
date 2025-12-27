<?php

use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;


Route::get('', fn() => to_route('job-posts.index'));
Route::resource('job-posts', JobPostController::class)
    ->only(['index', 'show']);
