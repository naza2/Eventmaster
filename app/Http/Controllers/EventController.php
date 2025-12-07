<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $eventos = Evento::withCount('equipos')
                       ->orderByDesc('fecha_inicio')
                       ->paginate(12);

        return view('eventos.index', compact('eventos'));
    }

    public function show(Evento $evento)
    {
        $evento->load(['equipos.participantes.user', 'jueces.user']);
        return view('eventos.show', compact('evento'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'max_miembros' => 'nullable|integer|min:1',
            'estado' => 'required|in:inscripcion,en_curso,finalizado',
            'banner' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('event_banners', 'public');
            $data['banner'] = $path;
        }

        $data['slug'] = Str::slug($data['nombre']);
        // Asegurar slug único
        $original = $data['slug'];
        $i = 1;
        while (Evento::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $original . '-' . $i++;
        }

        $evento = Evento::create($data);

        return redirect()->route('eventos.show', $evento)->with('success', 'Evento creado correctamente');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        
        return redirect()->back()->with('success', 'Evento eliminado correctamente');
    }
}