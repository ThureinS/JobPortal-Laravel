<?php

use App\Http\Controllers\JobPostController;
use Illuminate\Support\Facades\Route;

Route::resource('job-posts', JobPostController::class)
    ->only(['index']);
