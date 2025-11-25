<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/images', ImageController::class)->only(['index', 'store', 'destroy']);
Route::middleware(['auth:sanctum'])->post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Token based register to return token on create
Route::post('/register', [UserController::class, 'register']);

