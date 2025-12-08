<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function update(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto->equipo);

        $request->validate([
            'problema_resuelto' => 'required',
            'solucion_propuesta' => 'required',
            'impacto_social' => 'nullable|string',
            'github' => 'nullable|url',
            'demo' => 'nullable|url',
            'video_pitch' => 'nullable|url',
        ]);

        $proyecto->update($request->only(['problema_resuelto', 'solucion_propuesta', 'impacto_social']));

        $proyecto->repositorio()->updateOrCreate(
            ['proyecto_id' => $proyecto->getKey()],
            $request->only(['github', 'demo', 'video_pitch'])
        );

        return redirect()->route('equipos.show', $proyecto->equipo)
                        ->with('success', '¡Proyecto actualizado correctamente!');
    }
}