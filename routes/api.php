<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function (){
//Route::group([], function (){
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user_id}/boards', [UserController::class, 'boards']);
    Route::get('/users/{user_id}/board', [UserController::class, 'board']);

    Route::get('/boards/{id}/tasks', [BoardController::class, 'tasks']);

    Route::get('/tasks/{id}', [TaskController::class, 'show']);

    Route::post('/tasks', [TaskController::class, 'store']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::patch('/tasks/{id}', [TaskController::class, 'patch_update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});
