<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureJuezHasEspecialidad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Si el usuario es juez y no tiene especialidad, redirigir a selección
        if ($user && $user->hasRole('juez') && !$user->especialidad) {
            if (!$request->routeIs('especialidad.select') && !$request->routeIs('especialidad.store')) {
                return redirect()->route('especialidad.select')
                    ->with('info', 'Por favor, selecciona tu especialidad para continuar.');
            }
        }

        return $next($request);
    }
}
