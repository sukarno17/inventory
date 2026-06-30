<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Menambahkan middleware CORS untuk rute API secara global/spesifik
        $middleware->api(prepend: [
            \Fruitcake\Cors\HandleCors::class, // atau middleware cors bawaan laravel
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();