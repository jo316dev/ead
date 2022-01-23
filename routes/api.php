<?php

use App\Http\Controllers\{
    CourseController,
    LessonController,
    ModuleController,
    ReplySupportController,
    SupportController,
};
use App\Http\Controllers\Auth\{
    AuthController,
    ResetPasswordController
};
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/myprofile', [AuthController::class, 'myProfile'])->middleware('auth:sanctum');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('auth:sanctum');



/**
 * Rotas para reset de senha
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');




Route::middleware(['auth:sanctum'])->group(function () {


    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses', [CourseController::class, 'index']);

    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/courses/{id}/module', [ModuleController::class, 'index']);

    Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);
    Route::get('/lesson/{id}', [LessonController::class, 'show']);

    Route::get('/supports', [SupportController::class, 'index']);

    Route::get('/mysupports', [SupportController::class, 'mySupports']);

    // Add a question
    Route::post('/supports', [SupportController::class, 'store']);

    // Post a reply to support
    Route::post('replies', [ReplySupportController::class, 'createReply']);
});



Route::get('/', function () {
    return response()->json([
        'success' => true
    ]);
});
