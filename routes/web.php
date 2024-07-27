<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserInteractionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AccountController;
use App\Http\Middleware\CheckAuthenticatedAPI;
use Illuminate\Support\Facades\Route;

// Web Routes
Route::get('/', [ListController::class, 'show']);
Route::get('/register', [RegisterController::class, 'show']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])
    ->middleware(['signed'])
    ->name('verification.verify');


Route::prefix('verify')->group(function () {
    Route::get('/error', [VerificationController::class, 'verifyError'])
        ->name('verification.error');

    Route::post('/resend/{id}', [VerificationController::class, 'resendMail'])
        ->name('verification.resend');
});

// Public API Routes
Route::prefix('api/v1')->group(function () {
    Route::apiResource('list', ListController::class);

	// Auth routes
    Route::post('auth/register', [RegisterController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'authenticate']);
});


// Private API Routes
Route::prefix('api/v1')->middleware(CheckAuthenticatedAPI::class)->group(function () {
    Route::post('line', [LineController::class, 'store']);

    Route::post('interaction/{line}/view', [UserInteractionController::class, 'addView']);
    Route::post('interaction/{line}/like', [UserInteractionController::class, 'toggleLike']);
});

// Private Application Routes
Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'show'])->name('account.show');
});
