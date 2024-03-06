<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumGroupController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
/**
 * Route Prefixes for Forum Group
 */
Route::prefix('/forum-group')->group(function () {
    Route::get('/', [ForumGroupController::class, 'index']);
    Route::post('/', [ForumGroupController::class, 'store']);
    Route::get('/{forumGroup}', [ForumGroupController::class, 'show']);
    Route::put('/{forumGroup}', [ForumGroupController::class, 'update']);
    Route::delete('/{id}', [ForumGroupController::class, 'destroy']);
});
