<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\UserInteractionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckAuthenticatedAPI;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
* Web Routes
*/
Route::get('/', [ListController::class, 'show']);
Route::get('/register', [RegisterController::class, 'show']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

/*
* API Routes
*/
Route::apiResource('api/v1/list', ListController::class);

/*
* GET Routes
*/
Route::get('logout', [AuthController::class, 'logout']);

/*
* POST Routes
*/
Route::post('api/v1/line', [LineController::class]);
Route::post('api/v1/auth/register', [RegisterController::class, 'register']);
Route::post('api/v1/auth/login', [AuthController::class, 'authenticate']);

Route::post('api/v1/interaction/{line}/like', [UserInteractionController::class, 'toggleLike'])
    ->middleware(CheckAuthenticatedAPI::class);

Route::post('api/v1/interaction/{line}/view', [UserInteractionController::class, 'addView'])
    ->middleware(CheckAuthenticatedAPI::class);
