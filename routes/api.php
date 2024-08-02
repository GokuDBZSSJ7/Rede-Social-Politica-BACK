<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('auth/login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);
Route::get('logout', [AuthController::class, 'logout']);
Route::resource('post', PostController::class);
Route::resource('position', PositionController::class);
Route::resource('party', PartyController::class);
Route::resource('city', CityController::class);
Route::resource('state', StateController::class);
Route::resource('candidates', CandidateController::class);
Route::get('getCandidateByUserId/{id}', [UserController::class, 'getCandidateByUserId']);
Route::put('like/{id}', [PostController::class, 'addLike']);
Route::put('deslike/{id}', [PostController::class, 'removeLike']);
Route::put('approveCandidate/{id}', [PartyController::class, 'approveCandidate']);


Route::get('cityPerStateId/{id}', [CityController::class, 'getCitiesByState']);

Route::get('filterPendentsCandidates', [PartyController::class, 'filterPendentsCandidates']);

Route::group(['middleware' => ['auth:sanctum', 'access_control']], function () {
    Route::resource('users', UserController::class);
    Route::get('me', [AuthController::class, 'me']);

    Route::get('refresh', [AuthController::class, 'refresh']);
});
