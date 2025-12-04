<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class GanadorController extends Controller
{
    public function create(Evento $evento)
    {
        $this->authorize('declare-winners', $evento);
        $equipos = $evento->equipos()->withAvg('calificaciones', 'puntaje')->orderByDesc('calificaciones_avg_puntaje')->get();

        return view('ganadores.create', compact('evento', 'equipos'));
    }

    public function store(Request $request, Evento $evento)
    {
        $this->authorize('declare-winners', $evento);

        foreach ($request->ganadores as $posicion => $equipo_id) {
            $evento->ganadores()->create([
                'equipo_id' => $equipo_id,
                'posicion' => $posicion,
                'premio' => $request->premio[$posicion] ?? null
            ]);
        }

        $evento->update(['estado' => 'finalizado']);

        return redirect()->route('eventos.show', $evento)->with('success', 'Ganadores declarados y constancias listas!');
    }
}