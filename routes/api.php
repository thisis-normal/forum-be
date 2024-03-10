<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumGroupController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/viewImage', [UserController::class, 'viewImage'])
    ->middleware('auth:sanctum', 'ability:client,view-image');
/**
 * Route Prefixes for Forum Group
 */
Route::prefix('/forum-group')->group(function () {
    Route::get('/', [ForumGroupController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumGroupController::class, 'store']);
        Route::get('/{forumGroup}', [ForumGroupController::class, 'show']);
        Route::put('/{forumGroup}', [ForumGroupController::class, 'update']);
        Route::delete('/{forumGroup}', [ForumGroupController::class, 'destroy']);
    });
});
/**
 * Route Prefixes for Forum
 */
Route::prefix('/forum')->group(function () {
    Route::get('/', [ForumController::class, 'index']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumController::class, 'store']);
        Route::put('/{forum}', [ForumController::class, 'update']);
        Route::delete('/{forum}', [ForumController::class, 'destroy']);
    });
});
