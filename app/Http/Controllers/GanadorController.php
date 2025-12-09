<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EquipoGanadorMail;

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
            $ganador = $evento->ganadores()->create([
                'equipo_id' => $equipo_id,
                'posicion' => $posicion,
                'premio' => $request->premio[$posicion] ?? null,
                'comentario_jurado' => $request->comentario[$posicion] ?? null,
            ]);

            // Enviar correo a todos los miembros del equipo ganador
            try {
                $equipo = $ganador->equipo;
                $equipo->load('participantes.user');
                
                foreach ($equipo->participantes as $participante) {
                    if ($participante->user && $participante->user->email) {
                        Mail::to($participante->user->email)->send(new EquipoGanadorMail($ganador));
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Error enviando correos a ganadores: ' . $e->getMessage());
            }
        }

        $evento->update(['estado' => 'finalizado']);

        return redirect()->route('eventos.show', $evento)->with('success', 'Ganadores declarados y correos enviados!');
    }
}