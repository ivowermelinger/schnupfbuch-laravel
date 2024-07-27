<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserInteractionController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Middleware\CheckAuthenticatedAPI;
use Illuminate\Support\Facades\Route;

// Unthrottled API Routes
Route::prefix('api/v1')->group(function () {
    Route::apiResource('list', ListController::class);
});

// Web Routes
Route::middleware(['throttle:web'])->group(function () {
    Route::get('/', [ListController::class, 'show']);
    Route::get('/register', [RegisterController::class, 'show']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/login', [AuthController::class, 'show'])->name('login');


    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])
        ->middleware(['signed'])
        ->name('verification.verify');

    // Private Application Routes
    Route::middleware('auth')->group(function () {
        Route::get('/account', [AccountController::class, 'show'])->name('account.show');
    });

    Route::prefix('verify')->group(function () {
        Route::get('/error', [VerificationController::class, 'verifyError'])
            ->name('verification.error');

        Route::post('/resend/{id}', [VerificationController::class, 'resendMail'])
            ->name('verification.resend');
    });

    // Password reset routes
    Route::prefix('password')->group(function () {
        Route::get('forgot', [ForgotPasswordController::class, 'show'])
            ->name('password.request');

        Route::post('/forgot/send', [ForgotPasswordController::class, 'send'])
            ->name('password.email');

        Route::get('/reset/{token}', [ResetPasswordController::class, 'show'])
            ->name('password.reset');

        Route::post('/reset/save', [ResetPasswordController::class, 'reset']);
    });
});

// Throttled API Routes
Route::middleware(['throttle:api'])->group(function () {
    Route::prefix('api/v1')->middleware(CheckAuthenticatedAPI::class)->group(function () {
        Route::post('line', [LineController::class, 'store']);
        Route::post('interaction/{line}/view', [UserInteractionController::class, 'addView']);
        Route::post('interaction/{line}/like', [UserInteractionController::class, 'toggleLike']);
    });
});

// Stronger throttling for auth API routes
Route::middleware(['throttle:api_auth'])->group(function () {
    // Auth routes
    Route::prefix('api/v1')->group(function () {
        Route::post('auth/register', [RegisterController::class, 'register']);
        Route::post('auth/login', [AuthController::class, 'authenticate']);
    });
});
