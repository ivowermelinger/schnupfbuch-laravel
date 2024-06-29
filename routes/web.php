<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserInteractionController;

Route::get('/', [ListController::class, 'show']);

Route::apiResource('api/v1/list', ListController::class);

Route::post('api/v1/interaction/{id}/like', [UserInteractionController::class, 'toggleLike']);
