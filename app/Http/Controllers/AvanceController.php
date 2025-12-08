<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class AvanceController extends Controller
{
    public function store(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto->equipo);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'porcentaje_avance' => 'required|integer|min:0|max:100',
            'evidencias.*' => 'nullable|file|image|mimes:jpg,png,gif,webp,mp4|max:10240'
        ]);

        $evidencias = [];
        if ($request->hasFile('evidencias')) {
            foreach ($request->file('evidencias') as $file) {
                $evidencias[] = $file->store('avances', 'public');
            }
        }

        $proyecto->avances()->create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'evidencias' => $evidencias,
            'porcentaje_avance' => $request->porcentaje_avance
        ]);

        return redirect()->route('equipos.show', $proyecto->equipo)
                        ->with('success', '¡Avance publicado correctamente!');
    }
}