<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Criterio;
use App\Models\Evento;
use App\Models\Ganador;
use App\Notifications\EquipoGanadorNotification;
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

        // Verificar si todos los jueces ya calificaron todos los equipos
        $this->verificarYCalcularGanadores($equipo->evento);

        return redirect()->route('eventos.show', $equipo->evento)->with('success', 'Calificaciones guardadas');
    }

    /**
     * Verificar si todos los jueces calificaron y calcular ganadores automáticamente
     */
    private function verificarYCalcularGanadores(Evento $evento)
    {
        // Si el evento ya tiene ganadores, no hacer nada
        if ($evento->ganadores()->exists()) {
            return;
        }

        // Contar cuántos jueces hay en el evento
        $totalJueces = $evento->jueces()->count();

        if ($totalJueces === 0) {
            return; // No hay jueces, no se puede calcular
        }

        // Contar cuántos equipos hay en el evento
        $totalEquipos = $evento->equipos()->count();

        if ($totalEquipos === 0) {
            return; // No hay equipos, no se puede calcular
        }

        // Verificar si cada equipo tiene calificaciones de todos los jueces
        $todosCalificados = true;

        foreach ($evento->equipos as $equipo) {
            $juecesQueCalificaron = $equipo->calificaciones()
                ->distinct('juez_id')
                ->count('juez_id');

            if ($juecesQueCalificaron < $totalJueces) {
                $todosCalificados = false;
                break;
            }
        }

        // Si todos los jueces calificaron todos los equipos, calcular ganadores
        if ($todosCalificados) {
            $this->calcularGanadoresAutomaticos($evento);
        }
    }

    /**
     * Calcular y asignar ganadores automáticamente
     */
    private function calcularGanadoresAutomaticos(Evento $evento)
    {
        // Obtener equipos ordenados por promedio de calificaciones (descendente)
        $equipos = $evento->equipos()
            ->withAvg('calificaciones', 'puntaje')
            ->orderByDesc('calificaciones_avg_puntaje')
            ->limit(3)
            ->get();

        // Si no hay al menos 1 equipo, no hacer nada
        if ($equipos->isEmpty()) {
            return;
        }

        $posiciones = [
            0 => 1, // Primer lugar
            1 => 2, // Segundo lugar
            2 => 3, // Tercer lugar
        ];

        // Crear ganadores y enviar notificaciones
        foreach ($equipos as $index => $equipo) {
            $posicion = $posiciones[$index];

            // Crear registro de ganador
            $ganador = $evento->ganadores()->create([
                'equipo_id' => $equipo->id,
                'posicion' => $posicion,
                'premio' => null, // El admin puede agregar premios después si quiere
                'comentario_jurado' => null,
            ]);

            // Notificar a todos los participantes del equipo ganador
            $equipo->load('participantes.user');

            foreach ($equipo->participantes as $participante) {
                if ($participante->user) {
                    $participante->user->notify(new EquipoGanadorNotification($ganador));
                }
            }
        }

        // Cambiar estado del evento a finalizado
        $evento->update(['estado' => 'finalizado']);
    }
}
