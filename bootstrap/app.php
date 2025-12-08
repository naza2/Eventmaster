<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;
<<<<<<< HEAD
use App\Http\Middleware\EnsureJuezHasEspecialidad;
=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
<<<<<<< HEAD
            'juez.especialidad' => EnsureJuezHasEspecialidad::class,
        ]);

        // Agregar middleware global para web
        $middleware->web(append: [
            EnsureJuezHasEspecialidad::class,
=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions){
        //
    })->create();