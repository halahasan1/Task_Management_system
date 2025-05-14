<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\CommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Task Routes
    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']); 
        Route::post('/', [TaskController::class, 'store']);
        Route::get('{task}', [TaskController::class, 'show']);
        Route::put('{task}', [TaskController::class, 'update']);
        Route::delete('{task}', [TaskController::class, 'destroy']);
    });

    // Status Routes
    Route::prefix('statuses')->middleware('permission:manage-statuses')->group(function () {
        Route::get('/', [StatusController::class, 'index']);
        Route::post('/', [StatusController::class, 'store']);
        Route::put('{status}', [StatusController::class, 'update']);
        Route::delete('{status}', [StatusController::class, 'destroy']);
    });

    // Comment Routes
    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentController::class, 'store']);
        Route::put('{comment}', [CommentController::class, 'update']);
        Route::delete('{comment}', [CommentController::class, 'destroy']);
    });
});
