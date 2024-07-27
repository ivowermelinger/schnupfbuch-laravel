<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('web', function (Request $request) {
            return Limit::perMinute(80);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(250)->response(function (Request $request, array $headers) {
                return response()->json([
                    'message' => 'Zu viele Anfragen. Bitte versuchen Sie es später erneut.',
                    'errors' => ['global' => 'Zu viele Anfragen. Bitte versuchen Sie es später erneut.'],
                    'success' => false,
                ], 422);
            });
        });

        RateLimiter::for('api_auth', function (Request $request) {
            return Limit::perMinute(10)->response(function (Request $request, array $headers) {
                return response()->json([
                    'message' => 'Zu viele Anfragen. Bitte versuchen Sie es später erneut.',
                    'errors' => ['global' => 'Zu viele Anfragen. Bitte versuchen Sie es später erneut.'],
                    'success' => false,
                ], 422);
            });
        });
    }
}
