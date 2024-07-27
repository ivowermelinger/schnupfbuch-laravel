<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserInteractionController;
use App\Http\Controllers\VerificationController;
use App\Http\Middleware\CheckAuthenticatedAPI;
use Illuminate\Support\Facades\Route;

// Web Routes
Route::get('/', [ListController::class, 'show']);
Route::get('/register', [RegisterController::class, 'show']);

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])
	->middleware(['signed'])
	->name('verification.verify')
;

Route::get('/verify/error', [VerificationController::class, 'verifyError'])
	->middleware(['signed'])
	->name('verification.error')
;

Route::get('verify/resend/{id}', [VerificationController::class, 'resendMail'])
	->name('verification.resend')
;

// API Routes public
Route::apiResource('api/v1/list', ListController::class);

// GET Routes
Route::get('logout', [AuthController::class, 'logout']);

// POST Routes public
Route::post('api/v1/auth/register', [RegisterController::class, 'register']);
Route::post('api/v1/auth/login', [AuthController::class, 'authenticate']);

// API Routes private
Route::post('api/v1/line', [LineController::class])
	->middleware(CheckAuthenticatedAPI::class)
;

Route::post('api/v1/interaction/{line}/like', [UserInteractionController::class, 'toggleLike'])
	->middleware(CheckAuthenticatedAPI::class)
;

Route::post('api/v1/interaction/{line}/view', [UserInteractionController::class, 'addView'])
	->middleware(CheckAuthenticatedAPI::class)
;
