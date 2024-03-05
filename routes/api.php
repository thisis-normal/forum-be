<?php

use App\Http\Controllers\AuthController;
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
Route::group(['prefix' => 'forum-group'], function () {
    Route::get('/forum', function () {
        return 'forum';
    });
    Route::get('/forum/create', function () {
        return 'forum create';
    });
    Route::get('/forum/{id}', function ($id) {
        return 'forum ' . $id;
    });
    Route::put('/forum/{id}', function ($id) {
        return 'forum ' . $id;
    });
    Route::delete('/forum/{id}', function ($id) {
        return 'forum ' . $id;
    });
});
