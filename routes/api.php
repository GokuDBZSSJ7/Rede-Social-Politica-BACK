<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum', 'access_control']], function () {
    Route::resource('users', UserController::class);
    Route::get('me', [AuthController::class, 'me']);
    
    Route::get('refresh', [AuthController::class, 'refresh']);
});