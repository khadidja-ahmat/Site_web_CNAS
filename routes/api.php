<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoursesApiController;
use App\Http\Controllers\StudentApiController;

Route::get('courses', [CoursesApiController::class, 'courses']);

Route::get('students', [StudentApiController::class, 'students']);
Route::post('students', [StudentApiController::class, 'store']);
Route::get('students/{id}',  [StudentApiController::class, 'student']);
Route::PUT('students/{id}',  [StudentApiController::class, 'update']);
Route::delete('students/{id}',  [StudentApiController::class, 'delete']);
