<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('auth:api')->put('/users/{id}/flames', [UserController::class, 'updateFlames']);

Route::middleware('auth:api')->post('/users/{id}/flames', [UserController::class, 'updateFlames']);
Auth::routes();

Route::get('/checkUserExists/{username}', [UserController::class, 'checkUserExists']);

Route::middleware('api')->group(function () {
    Route::get('/api/users', [UserController::class, 'index']);
    Route::get('/api/user', [UserController::class, 'getCurrentUser']);
});
