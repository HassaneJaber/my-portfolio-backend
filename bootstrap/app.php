<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Dotenv\Dotenv; // Ensure dotenv is available

// ✅ Manually load .env file (if needed)
$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->safeLoad();

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Add your global middleware here
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Add exception handling here
    })
    ->create();
