<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);

Route::group(['middleware' => ['auth:sanctum', 'access_control']], function () {
    Route::resource('users', UserController::class);
});