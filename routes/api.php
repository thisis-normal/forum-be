<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumGroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * API Route for User Authentication
 */
Route::post('/register', [ClientAuthController::class, 'register']);
Route::post('/login', [ClientAuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [ClientAuthController::class, 'me']);
    Route::post('/logout', [ClientAuthController::class, 'logout']);
});

/**
 * Route Prefixes for Admin Authentication
 */
Route::prefix('/admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/register', [AdminAuthController::class, 'register']);
        Route::get('/me', [AdminAuthController::class, 'me']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
    });
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
    Route::get('/{forum}', [ForumController::class, 'show']);
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
    Route::get('/', [PrefixController::class, 'index']);
    Route::post('/', [PrefixController::class, 'store']);
    Route::put('/{prefix}', [PrefixController::class, 'update']);
    Route::delete('/{prefix}', [PrefixController::class, 'destroy']);
});

/**
 * Route Prefixes for Thread
 */
Route::prefix('/thread')->group(function () {
    Route::get('/{thread}/posts', [PostController::class, 'index'])
        ->where('page', '[0-9]+')->where('thread', '[0-9]+');
    Route::get('/{thread}', [ThreadController::class, 'showThread']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ThreadController::class, 'store']);
        Route::put('/{thread}', [ThreadController::class, 'update']);
        Route::delete('/{thread}', [ThreadController::class, 'destroy']);
    });
});
/**
 * Route Prefixes for Post
 */
Route::prefix('/post')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
    });
});
