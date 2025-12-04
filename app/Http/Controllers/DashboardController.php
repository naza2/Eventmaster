<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('filament.admin.index');
        }

        $misEquipos = $user->participantes()->with('equipo.evento')->get();

        return view('dashboard', compact('misEquipos'));
    }

    // En tu DashboardController 
    public function misEquipos()
    {
        $user = auth()->user();
        $participantes = $user->participantes()->with(['equipo.evento', 'equipo.proyecto.avances'])->get();

        return view('equipos.index', compact('participantes'));
    }
}