<?php

namespace App\Http\Controllers;

use App\Models\Juez;
use Illuminate\Http\Request;

class JuezPanelController extends Controller
{
    /**
     * Muestra el panel del juez con sus eventos asignados
     */
    public function index()
    {
        // Verificar que el usuario sea juez
        if (!auth()->user()->esJuez()) {
            abort(403, 'No tienes acceso a este panel');
        }

        // Obtener los eventos asignados al juez
        $eventosAsignados = Juez::where('user_id', auth()->id())
            ->where('activo', true)
            ->with([
                'evento.equipos.participantes',
                'evento.votos' => function($query) {
                    $query->where('juez_id', auth()->id());
                }
            ])
            ->get()
            ->map(function($juez) {
                $evento = $juez->evento;
                $evento->mi_voto = $evento->votos->first();
                return $evento;
            });

        return view('juez.panel', compact('eventosAsignados'));
    }
}
