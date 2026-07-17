<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();

$isVercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL') || isset($_SERVER['VERCEL_URL']) || isset($_ENV['VERCEL_URL']) || isset($_ENV['IS_VERCEL']) || isset($_SERVER['IS_VERCEL']);
if ($isVercel) {
    $storagePath = '/tmp/storage';
    $app->useStoragePath($storagePath);
    
    foreach (['/framework/views', '/framework/cache/data', '/framework/sessions', '/logs'] as $dir) {
        if (!is_dir($storagePath . $dir)) {
            @mkdir($storagePath . $dir, 0777, true);
        }
    }
    
    // Copy SQLite to /tmp so it becomes writable for Demo
    $tmpDb = '/tmp/database.sqlite';
    if (!file_exists($tmpDb)) {
        @copy(__DIR__.'/../database/database.sqlite', $tmpDb);
    }
    $_ENV['DB_DATABASE'] = $tmpDb;
    putenv('DB_DATABASE='.$tmpDb);
}

return $app;
