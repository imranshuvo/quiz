<?php

use App\Http\Middleware\BootCurrentWorkspace;
use App\Http\Middleware\ResolveApiWorkspace;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Laravel\Sanctum\Http\Middleware\CheckAbilities;
use Laravel\Sanctum\Http\Middleware\CheckForAnyAbility;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            BootCurrentWorkspace::class,
        ]);

        $middleware->alias([
            'workspace.api' => ResolveApiWorkspace::class,
            'abilities' => CheckAbilities::class,
            'ability' => CheckForAnyAbility::class,
        ]);

        // Tenant scope must be booted before implicit route-model binding.
        $middleware->prependToPriorityList(
            SubstituteBindings::class,
            ResolveApiWorkspace::class,
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
