<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\App;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: []);

        $middleware->trustHosts(at: ['laravel.test']);;
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->render(function (Throwable $e, $request) {
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Check if the environment is production
            if (APP::environment() === 'production') {
                // Handle all errors in production
                return response()->view('errors.index', [
                    'message' => $e->getMessage(),
                    'statusCode' => $statusCode,
                ], $statusCode);
            } else {
                // Handle only 400-499 errors in non-production environments
                if ($statusCode >= 400 && $statusCode <= 499) {
                    return response()->view('errors.index', [
                        'message' => $e->getMessage(),
                        'statusCode' => $statusCode,
                    ], $statusCode);
                }
            }

            // Optionally, let other exceptions fall back to the default behavior
            return null;
        });
    })->create();
