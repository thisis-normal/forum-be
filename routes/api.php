<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumGroupController;
use App\Http\Controllers\HomeController;
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
    ->middleware('auth:sanctum', 'ability:user,view-image');
/**
 * Route Prefixes for Forum Group
 */
Route::prefix('/forum-group')->group(function () {
    Route::get('/', [ForumGroupController::class, 'index']);
    Route::get('/{forumGroup}', [ForumGroupController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumGroupController::class, 'store']);
        Route::put('/{forumGroup}', [ForumGroupController::class, 'update']);
        Route::delete('/{forumGroup}', [ForumGroupController::class, 'destroy']);
    });
});
/**
 * Route Prefixes for Forum
 */
Route::prefix('/forum')->group(function () {
    Route::get('/', [ForumController::class, 'index']);
    Route::get('/{forumGroup}', [ForumController::class, 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumController::class, 'store']);
        Route::put('/{forum}', [ForumController::class, 'update']);
        Route::delete('/{forum}', [ForumController::class, 'destroy']);
    });
});
/**
 * Route Prefixes for client homepage
 */
Route::prefix('/home')->group(function () {
    Route::get('/forum-list', [HomeController::class, 'forumList']);
    Route::get('/latest-thread', [HomeController::class, 'latestThread']);
    Route::get('/latest-post', [HomeController::class, 'latestPost']);
});
