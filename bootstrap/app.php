<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\File;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function (\Illuminate\Routing\Router $router) {
            collect(File::allFiles(base_path("src/BoundedContext/**/Infrastructure/routes")))
                ->each(fn(SplFileInfo $file) =>
                $router->middleware($type = $file->getBasename('.php'))
                    ->prefix($type)
                    ->group($file->getRealPath())
                );
        },
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

