<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Equipo;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Mostrar formulario para crear proyecto
     */
    public function create(Equipo $equipo)
    {
        return view('proyectos.create', compact('equipo'));
    }

    /**
     * Guardar nuevo proyecto
     */
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

    /**
     * Mostrar formulario para editar proyecto
     */
    public function edit(Equipo $equipo)
    {
        $proyecto = $equipo->proyecto;

        if (!$proyecto) {
            return redirect()->route('proyecto.create', $equipo)
                            ->with('info', 'Este equipo aún no tiene proyecto');
        }

        return view('proyectos.edit', compact('equipo', 'proyecto'));
    }

    /**
     * Actualizar proyecto
     */
    public function update(Request $request, Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        $proyecto = $equipo->proyecto;

        if (!$proyecto) {
            return redirect()->route('proyecto.create', $equipo)
                            ->with('error', 'Proyecto no encontrado');
        }

        $data = $request->validate([
            'problema_resuelto' => 'required|string',
            'solucion_propuesta' => 'required|string',
            'tecnologias' => 'nullable|string',
            'github' => 'nullable|url',
            'demo' => 'nullable|url',
            'video_pitch' => 'nullable|url',
        ]);

        $proyecto->update($data);

        if ($proyecto->repositorio) {
            $proyecto->repositorio->update([
                'github' => $request->github,
                'demo' => $request->demo,
                'video_pitch' => $request->video_pitch,
            ]);
        } else {
            $proyecto->repositorio()->create([
                'github' => $request->github,
                'demo' => $request->demo,
                'video_pitch' => $request->video_pitch,
            ]);
        }

        return redirect()->route('equipos.proyecto', $equipo)
                        ->with('success', 'Proyecto actualizado correctamente');
    }
}