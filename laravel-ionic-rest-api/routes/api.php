<?php

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

Route::middleware('guest')->get('/checkUserExists/{username}', [UserController::class, 'checkUserExists']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    // 'prefix' => 'auth'
], function($router) {
    Route::get('users', [UserController::class, 'index']);
    Route::get('user', [UserController::class, 'getCurrentUser']);

    Route::put('users/{id}/flames', [UserController::class, 'updateFlames']);
    Route::post('users/{id}/flames', [UserController::class, 'updateFlames']);

});
