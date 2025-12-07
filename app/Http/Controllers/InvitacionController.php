<?php

namespace App\Http\Controllers;

use App\Models\Invitacion;
use App\Models\Equipo;
use App\Models\User;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitacionController extends Controller
{
    /**
     * Mostrar invitaciones pendientes del usuario autenticado
     */
    public function index()
    {
        $invitaciones = Auth::user()
            ->invitacionesPendientes()
            ->with(['equipo.evento', 'invitante'])
            ->latest()
            ->get();

        return view('invitaciones.index', compact('invitaciones'));
    }

    /**
     * Mostrar formulario para invitar miembros
     */
    public function create(Equipo $equipo, Request $request)
    {
        // Verificar que el usuario sea líder del equipo
        $this->authorize('invite', $equipo);

        // Obtener usuarios con rol "usuario" que no estén en el equipo
        $query = User::role('usuario')
            ->whereDoesntHave('equipos', function($q) use ($equipo) {
                $q->where('equipos.id', $equipo->id);
            })
            ->with('carrera');

        // Búsqueda
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('matricula', 'like', "%{$search}%")
                  ->orWhereHas('carrera', function($query) use ($search) {
                      $query->where('nombre', 'like', "%{$search}%");
                  });
            });
        }

        $usuarios = $query->paginate(10);

        return view('equipos.invitar', compact('equipo', 'usuarios'));
    }

    /**
     * Enviar invitación a un usuario para unirse a un equipo
     */
    public function enviar(Request $request, Equipo $equipo)
    {
        // Verificar que el usuario sea líder del equipo
        $this->authorize('invite', $equipo);

        $request->validate([
            'invitado_id' => 'required|exists:users,id',
            'mensaje' => 'nullable|string|max:500',
        ]);

        $invitado = User::findOrFail($request->invitado_id);

        // Verificar que no esté ya en el equipo
        if ($equipo->participantes()->where('user_id', $invitado->id)->exists()) {
            return back()->with('error', 'Este usuario ya es miembro del equipo.');
        }

        // Verificar que no haya una invitación pendiente
        $invitacionExistente = Invitacion::where('equipo_id', $equipo->id)
            ->where('invitado_id', $invitado->id)
            ->where('estado', 'pendiente')
            ->exists();

        if ($invitacionExistente) {
            return back()->with('error', 'Ya existe una invitación pendiente para este usuario.');
        }

        // Verificar que el equipo no esté lleno
        $maxMiembros = $equipo->evento->max_miembros;
        if ($equipo->participantes()->count() >= $maxMiembros) {
            return back()->with('error', 'El equipo ya alcanzó el máximo de miembros.');
        }

        Invitacion::create([
            'equipo_id' => $equipo->id,
            'invitado_por' => Auth::id(),
            'invitado_id' => $invitado->id,
            'mensaje' => $request->mensaje,
        ]);

        return back()->with('success', 'Invitación enviada exitosamente.');
    }

    /**
     * Aceptar una invitación
     */
    public function aceptar(Invitacion $invitacion)
    {
        // Verificar que la invitación sea para el usuario autenticado
        if ($invitacion->invitado_id !== Auth::id()) {
            abort(403, 'No tienes permiso para aceptar esta invitación.');
        }

        // Verificar que la invitación esté pendiente
        if ($invitacion->estado !== 'pendiente') {
            return back()->with('error', 'Esta invitación ya fue respondida.');
        }

        // Verificar que el equipo no esté lleno
        $equipo = $invitacion->equipo;
        $maxMiembros = $equipo->evento->max_miembros;
        if ($equipo->participantes()->count() >= $maxMiembros) {
            return back()->with('error', 'El equipo ya alcanzó el máximo de miembros.');
        }

        // Aceptar invitación y agregar al equipo
        $invitacion->aceptar();

        Participante::create([
            'user_id' => Auth::id(),
            'equipo_id' => $equipo->id,
            'rol' => 'miembro',
        ]);

        // Rechazar otras invitaciones pendientes del mismo evento
        Invitacion::where('invitado_id', Auth::id())
            ->whereHas('equipo', function($query) use ($equipo) {
                $query->where('evento_id', $equipo->evento_id);
            })
            ->where('id', '!=', $invitacion->id)
            ->where('estado', 'pendiente')
            ->update([
                'estado' => 'rechazada',
                'respondida_en' => now(),
            ]);

        return redirect()->route('equipos.show', $equipo)
            ->with('success', 'Te has unido al equipo exitosamente.');
    }

    /**
     * Rechazar una invitación
     */
    public function rechazar(Invitacion $invitacion)
    {
        // Verificar que la invitación sea para el usuario autenticado
        if ($invitacion->invitado_id !== Auth::id()) {
            abort(403, 'No tienes permiso para rechazar esta invitación.');
        }

        // Verificar que la invitación esté pendiente
        if ($invitacion->estado !== 'pendiente') {
            return back()->with('error', 'Esta invitación ya fue respondida.');
        }

        $invitacion->rechazar();

        return back()->with('success', 'Invitación rechazada.');
    }
}
