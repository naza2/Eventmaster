<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Criterio;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function create(Equipo $equipo)
    {
        $this->authorize('calificar', $equipo);

        $criterios = Criterio::where('evento_id', $equipo->evento_id)
                            ->orWhereNull('evento_id')
                            ->get();

        return view('calificaciones.create', compact('equipo', 'criterios'));
    }

    public function store(Request $request, Equipo $equipo)
    {
        $this->authorize('calificar', $equipo);

        foreach ($request->puntaje as $criterio_id => $puntaje) {
            $equipo->calificaciones()->updateOrCreate(
                ['juez_id' => auth()->id(), 'criterio_id' => $criterio_id],
                ['puntaje' => $puntaje, 'comentario' => $request->comentario[$criterio_id] ?? null]
            );
        }

        return redirect()->route('eventos.show', $equipo->evento)->with('success', 'Calificaciones guardadas');
    }
}