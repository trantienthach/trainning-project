<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
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

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register'])->name('register');

    Route::middleware('auth:api')->group( function () {
        Route::put('change-password', [AuthController::class,'changePassword'])->name('change_password');
        Route::get('user', [AuthController::class,'getUserAuth'])->name('user');
        Route::post('logout', [AuthController::class,'logout'])->name('logout');
    });
});

Route::middleware('auth:api')->group( function () {
    Route::resource('user', UserController::class);
    Route::resource('project', ProjectController::class);
});

