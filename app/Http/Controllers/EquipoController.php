<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Evento;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    // Listado de equipos de un evento (si lo necesitas)
    public function index(Evento $evento)
    {
        $equipos = $evento->equipos()->with('participantes.user')->paginate(10);
        return view('equipos.index', compact('evento', 'equipos'));
    }

    // Crear equipo
    public function create(Evento $evento)
    {
        $this->authorize('create', Equipo::class);

        if ($evento->estado !== 'inscripcion') {
            abort(403, 'Las inscripciones están cerradas');
        }

        return view('equipos.create', compact('evento'));
    }

    // Guardar equipo
    public function store(Request $request, Evento $evento)
    {
        $this->authorize('create', Equipo::class);

        $data = $request->validate([
            'nombre_equipo'     => 'required|string|max:255|unique:equipos,nombre_equipo',
            'nombre_proyecto'   => 'required|string|max:255',
            'descripcion_proyecto' => 'required|string',
            'logo'              => 'nullable|image|max:2048',
            'logo_url'          => 'nullable|url',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos_equipos', 'public');
        } elseif ($request->filled('logo_url')) {
            $logoPath = $request->logo_url;
        }

        $equipo = $evento->equipos()->create([
            'nombre_equipo'       => $data['nombre_equipo'],
            'nombre_proyecto'     => $data['nombre_proyecto'],
            'descripcion_proyecto'=> $data['descripcion_proyecto'],
            'logo'                => $logoPath,
        ]);

        // El creador es líder
        $equipo->participantes()->create([
            'user_id'     => auth()->id(),
            'carrera_id'  => auth()->user()->carrera_id,
            'num_control' => auth()->user()->matricula,
            'rol'         => 'lider',
            'es_lider'    => true,
        ]);

        return redirect()->route('equipos.show', $equipo)
            ->with('success', '¡Equipo creado exitosamente!');
    }

    // Dashboard principal del equipo
    public function show(Equipo $equipo)
    {
        $this->authorize('view', $equipo);

        $equipo->load([
            'evento.ganadores',
            'participantes.user.carrera',
            'proyecto.avances.user',
            'proyecto.repositorio',
            'asesorias.asesor',
            'calificaciones.criterio'
        ]);

        // Verificar si este equipo es ganador
        $esGanador = $equipo->evento->ganadores->where('equipo_id', $equipo->id)->first();

        // Calcular promedio de calificaciones
        $promedioCalificacion = $equipo->calificaciones->avg('puntaje');

        return view('equipos.show', compact('equipo', 'esGanador', 'promedioCalificacion'));
    }

    // PESTAÑAS REALES - Aquí están las 5 que querías
    public function miembros(Equipo $equipo)
    {
        $this->authorize('view', $equipo);
        $equipo->load('participantes.user.carrera');
        return view('equipos.miembros', compact('equipo'));
    }

    public function proyecto(Equipo $equipo)
    {
        $this->authorize('view', $equipo);
        $equipo->load('proyecto');
        return view('equipos.proyecto', compact('equipo'));
    }

    public function avances(Equipo $equipo)
    {
        $this->authorize('view', $equipo);
        $equipo->load('proyecto.avances.user');
        return view('equipos.avances', compact('equipo'));
    }

    public function repositorio(Equipo $equipo)
    {
        $this->authorize('view', $equipo);
        $equipo->load('proyecto.repositorio');
        return view('equipos.repositorio', compact('equipo'));
    }

    public function asesoria(Equipo $equipo)
    {
        $this->authorize('view', $equipo);
        $equipo->load('asesorias.asesor');
        return view('equipos.asesoria', compact('equipo'));
    }
}