<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumGroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::get('/viewImage', [UserController::class, 'viewImage'])
    ->middleware('auth:sanctum', 'ability:user,view-image');

/**
 * Route Prefixes for client homepage
 */
Route::prefix('/home')->group(function () {
    Route::get('/forum-list', [HomeController::class, 'forumList']);
    Route::get('/latest-threads', [HomeController::class, 'latestThreads']);
    Route::get('/latest-users', [HomeController::class, 'latestUsers']);
    Route::get('/forum-statistics', [HomeController::class, 'forumStatistics']);
});


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
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ForumController::class, 'store']);
        Route::put('/{forum}', [ForumController::class, 'update']);
        Route::delete('/{forum}', [ForumController::class, 'destroy']);
    });
});

/**
 * Route Prefixes for Prefix
 */
Route::prefix('/prefix')->group(function () {
    Route::get('/',[PrefixController::class,'index']);
    Route::post('/',[PrefixController::class,'store']);
    Route::put('/{prefix}',[PrefixController::class,'update']);
    Route::delete('/{prefix}',[PrefixController::class,'destroy']);
});

/**
 * Route Prefixes for Thread
 */
Route::prefix('/thread')->group(function () {
    Route::get('/',[ThreadController::class,'index']);
    Route::post('/',[ThreadController::class,'store']);
    Route::get('/{thread}/{page?}',[ThreadController::class,'show'])
        ->where('page','[0-9]+');
    Route::put('/{thread}',[ThreadController::class,'update']);
    Route::delete('/{thread}',[ThreadController::class,'destroy']);
});
