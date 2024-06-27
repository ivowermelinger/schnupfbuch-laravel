<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;

Route::get('/', [ListController::class, 'show']);

Route::apiResource('api/v1/list', ListController::class);
