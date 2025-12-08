<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Evento;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index(Evento $evento){
        $equipos = $evento->equipos()->with('participantes.user')->paginate(10);
        return view('equipos.index', compact('evento', 'equipos'));
    }

    public function create(Evento $evento)
    {
        $this->authorize('create', Equipo::class);
        if ($evento->getAttribute('estado') !== 'inscripcion') {
            abort(403, 'Las inscripciones están cerradas');
        }
        return view('equipos.create', compact('evento'));
    }

    public function store(Request $request, Evento $evento){
        $this->authorize('create', Equipo::class);

        $data = $request->validate([
            'nombre_equipo' => 'required|unique:equipos',
            'nombre_proyecto' => 'required',
            'descripcion_proyecto' => 'required',
        ]);

        $equipo = $evento->equipos()->create($data);
        $equipo->participantes()->create([
            'user_id' => auth()->id(),
            'carrera_id' => auth()->user()->carrera_id,
            'num_control' => auth()->user()->matricula,
            'rol' => 'lider',
            'es_lider' => true
        ]);

        return redirect()->route('equipos.show', $equipo)->with('success', 'Equipo creado');
    }

    public function show(Equipo $equipo){
        $equipo->load([
            'evento',
            'participantes.user.carrera',
            'proyecto.avances.user',
            'proyecto.repositorio',
            'asesorias.asesor'
        ]);
        return view('equipos.show', compact('equipo'));
    }
}