<?php

use App\Http\Controllers\{
    CourseController,
    LessonController,
    ModuleController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/courses/{id}/module', [ModuleController::class, 'index']);

Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
Route::get('/lesson/{id}', [LessonController::class, 'show']);


Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
