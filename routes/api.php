<?php

use App\Http\Controllers\{
    CourseController,
    LessonController,
    ModuleController,
    SupportController
};
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/courses/{id}/module', [ModuleController::class, 'index']);

Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
Route::get('/lesson/{id}', [LessonController::class, 'show']);

Route::get('/supports', [SupportController::class, 'index']);

// Add a question
Route::post('/supports', [SupportController::class, 'store']);

// Post a reply to support
Route::post('/supports/{id}/replies', [SupportController::class, 'reply']);


Route::get('/user', function () {

    $users = Lesson::all();

    return response()->json($users);
});

Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
