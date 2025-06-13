<?php

use App\Http\Controllers\LearnerProgressController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/learner-progress');

Route::get('/learner-progress', [LearnerProgressController::class, 'index']);
