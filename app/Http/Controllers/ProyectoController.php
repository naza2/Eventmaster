<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function store(Request $request, Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        $data = $request->validate([
            'problema_resuelto' => 'required|string',
            'solucion_propuesta' => 'required|string',
            'tecnologias' => 'nullable|string',
            'github' => 'nullable|url',
            'demo' => 'nullable|url',
            'video_pitch' => 'nullable|url',
        ]);

        $proyecto = $equipo->proyecto()->create($data);

        $proyecto->repositorio()->create([
            'github' => $request->github,
            'demo' => $request->demo,
            'video_pitch' => $request->video_pitch,
        ]);

        return redirect()->route('equipos.proyecto', $equipo)
            ->with('success', '¡Proyecto completado exitosamente!');
    }
}