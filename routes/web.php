<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Pages\App;
use App\Livewire\Pages\Settings;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EmailVerificationMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes
Route::get('/', App\Index::class)->middleware(EmailVerificationMiddleware::class)->name('home');

Route::prefix('email/verify')->group(function () {
    Route::get('/', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
});

// Redirect when authenticated
Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');

    Route::get('password/reset', Email::class)
        ->name('password.request');

    Route::get('password/reset/{token}', Reset::class)
        ->name('password.reset');
});

// Authenticated and email verified
Route::middleware([
    'auth',
    EmailVerificationMiddleware::class,
])->group(function () {
    Route::get('logout', LogoutController::class)
        ->name('logout');

    Route::prefix('settings')->group(function () {
        Route::get('/', Settings\Index::class)->name('settings.index');
        Route::get('/my-lines', Settings\UserLines::class)->name('settings.lines');
    });
});
