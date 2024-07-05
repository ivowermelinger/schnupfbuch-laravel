<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserInteractionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LineController;
use App\Http\Middleware\CheckAuthenticatedAPI;

Route::get('/', [ListController::class, 'show']);

Route::apiResource('api/v1/list', ListController::class);
Route::apiResource('api/v1/line', LineController::class);

Route::post('api/v1/auth/login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout']);

Route::post('api/v1/interaction/{line}/like', [UserInteractionController::class, 'toggleLike'])
    ->middleware(CheckAuthenticatedAPI::class);

Route::post('api/v1/interaction/{line}/view', [UserInteractionController::class, 'addView'])
    ->middleware(CheckAuthenticatedAPI::class);
