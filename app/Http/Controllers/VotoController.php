<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Voto;
use Illuminate\Http\Request;

class VotoController extends Controller
{
    /**
     * Muestra el formulario de votación para un evento
     */
    public function create(Evento $evento)
    {
        // Verificar que el usuario es juez del evento
        if (!auth()->user()->esJuezDe($evento)) {
            abort(403, 'No eres juez de este evento');
        }

        // Verificar que el evento esté finalizado
        if ($evento->estado !== 'finalizado') {
            return redirect()->back()->with('error', 'Solo puedes votar cuando el evento ha finalizado');
        }

        // Obtener equipos del evento
        $equipos = $evento->equipos()->with('participantes.user')->get();

        // Verificar si ya votó
        $votoExistente = Voto::where('juez_id', auth()->id())
                            ->where('evento_id', $evento->id)
                            ->first();

        return view('votos.create', compact('evento', 'equipos', 'votoExistente'));
    }

    /**
     * Guarda el voto del juez
     */
    public function store(Request $request, Evento $evento)
    {
        // Verificar que el usuario es juez del evento
        if (!auth()->user()->esJuezDe($evento)) {
            abort(403, 'No eres juez de este evento');
        }

        // Verificar que el evento esté finalizado
        if ($evento->estado !== 'finalizado') {
            return redirect()->back()->with('error', 'Solo puedes votar cuando el evento ha finalizado');
        }

        $data = $request->validate([
            'primer_lugar_id' => 'required|exists:equipos,id',
            'segundo_lugar_id' => 'required|exists:equipos,id',
            'tercer_lugar_id' => 'required|exists:equipos,id',
            'comentario' => 'nullable|string|max:1000',
        ]);

        // Validar que los equipos sean diferentes
        if ($data['primer_lugar_id'] == $data['segundo_lugar_id'] ||
            $data['primer_lugar_id'] == $data['tercer_lugar_id'] ||
            $data['segundo_lugar_id'] == $data['tercer_lugar_id']) {
            return back()->withErrors(['error' => 'Debes seleccionar equipos diferentes para cada puesto']);
        }

        // Validar que los equipos pertenezcan al evento
        $equiposValidos = $evento->equipos()->pluck('id')->toArray();
        if (!in_array($data['primer_lugar_id'], $equiposValidos) ||
            !in_array($data['segundo_lugar_id'], $equiposValidos) ||
            !in_array($data['tercer_lugar_id'], $equiposValidos)) {
            return back()->withErrors(['error' => 'Los equipos seleccionados deben pertenecer a este evento']);
        }

        // Crear o actualizar el voto
        Voto::updateOrCreate(
            [
                'juez_id' => auth()->id(),
                'evento_id' => $evento->id,
            ],
            $data
        );

        return redirect()->route('juez.panel')->with('success', '¡Tu voto ha sido registrado exitosamente!');
    }
}
