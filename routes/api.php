<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);
Route::get('logout', [AuthController::class, 'logout']);
Route::resource('post', PostController::class);
Route::resource('office', OfficeController::class);
Route::resource('party', PartyController::class);
route::resource('city', CityController::class);
route::resource('state', StateController::class);

Route::get('cityPerStateId/{id}', [CityController::class, 'getCitiesByState']);

Route::group(['middleware' => ['auth:sanctum', 'access_control']], function () {
    Route::resource('users', UserController::class);
    Route::get('me', [AuthController::class, 'me']);
    
    Route::get('refresh', [AuthController::class, 'refresh']);
});