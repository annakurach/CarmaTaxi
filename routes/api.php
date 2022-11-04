<?php

use App\Http\Controllers\Api\ApiTokenController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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

Route::get('', function () {
    return response(['error' => true], 404);
})->name('error');
Route::post('token', [ApiTokenController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('account', [UserController::class, 'show']);
    Route::apiResource('posts', PostController::class);
});
