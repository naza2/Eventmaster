<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Invitacion;
use App\Models\User;
use App\Models\Participante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitacionEquipoMail;
use App\Mail\InvitacionAceptadaMail;
use App\Mail\InvitacionRechazadaMail;

class InvitacionController extends Controller
{
    /**
     * Mostrar invitaciones pendientes del usuario autenticado
     */
    public function index()
    {
        $invitaciones = Auth::user()
            ->invitacionesPendientes()
            ->with(['equipo.evento', 'invitante.user'])
            ->latest()
            ->get();

        return view('invitaciones.index', compact('invitaciones'));
    }

    /**
     * Formulario para invitar participantes (alumnos) al equipo
     */
   public function create(Equipo $equipo, Request $request)
{
    $this->authorize('invite', $equipo);

    // 1. Obtener TODOS los usuarios con rol "usuario" (alumnos)
    $query = User::role('usuario')
        ->with(['carrera'])
        ->whereDoesntHave('participantes', function ($q) use ($equipo) {
            $q->where('equipo_id', $equipo->id);
        });

    // 2. Búsqueda
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('matricula', 'like', "%{$search}%")
              ->orWhereHas('carrera', fn($c) => $c->where('nombre', 'like', "%{$search}%"));
        });
    }

    $usuarios = $query->paginate(12)->withQueryString();

    return view('equipos.invitar', compact('equipo', 'usuarios'));
}
    /**
     * Enviar invitación a un participante
     */
    public function enviar(Request $request, Equipo $equipo)
    {
        $this->authorize('invite', $equipo);

        $request->validate([
            'invitado_id' => 'required|exists:users,id',
            'mensaje'     => 'nullable|string|max:1000',
        ]);

        $invitado = User::findOrFail($request->invitado_id);

        // Validaciones críticas
        if (!$invitado->hasRole('usuario')) {
            return back()->with('error', 'Solo puedes invitar a alumnos.');
        }

        if ($equipo->participantes()->where('user_id', $invitado->id)->exists()) {
            return back()->with('error', 'Este alumno ya está en tu equipo.');
        }

        if ($equipo->participantes()->count() >= $equipo->evento->max_miembros) {
            return back()->with('error', 'El equipo ya está lleno.');
        }

        if (Invitacion::where('equipo_id', $equipo->id)
            ->where('invitado_id', $invitado->id)
            ->where('estado', 'pendiente')
            ->exists()) {
            return back()->with('error', 'Ya enviaste una invitación a este alumno.');
        }

        // Crear invitación
        $invitacion = Invitacion::create([
            'equipo_id'     => $equipo->id,
            'invitado_por'  => Auth::id(),
            'invitado_id'   => $invitado->id,
            'mensaje'       => $request->mensaje,
            'estado'        => 'pendiente',
        ]);

        // Enviar correo en cola
        Mail::to($invitado)->queue(new InvitacionEquipoMail($invitacion));

        return back()->with('success', "¡Invitación enviada a {$invitado->name}!");
    }

    /**
     * Aceptar invitación
     */
    public function aceptar(Invitacion $invitacion)
    {
        if ($invitacion->invitado_id !== Auth::id()) {
            abort(403);
        }

        if ($invitacion->estado !== 'pendiente') {
            return back()->with('error', 'Esta invitación ya no es válida.');
        }

        $equipo = $invitacion->equipo;

        if ($equipo->participantes()->count() >= $equipo->evento->max_miembros) {
            $invitacion->update(['estado' => 'rechazada', 'respondida_en' => now()]);
            return back()->with('error', 'El equipo ya está lleno.');
        }

        // Aceptar invitación
        $invitacion->update(['estado' => 'aceptada', 'respondida_en' => now()]);

        // Añadir al equipo
        $equipo->participantes()->create([
            'user_id'     => Auth::id(),
            'rol'          => 'miembro',
        ]);

        // Notificar al líder
        Mail::to($invitacion->invitante)->queue(new InvitacionAceptadaMail($invitacion));

        // Rechazar otras invitaciones del mismo evento automáticamente
        Invitacion::where('invitado_id', Auth::id())
            ->whereHas('equipo', fn($q) => $q->where('evento_id', $equipo->evento_id))
            ->where('id', '!=', $invitacion->id)
            ->where('estado', 'pendiente')
            ->update(['estado' => 'rechazada', 'respondida_en' => now()]);

        return redirect()
            ->route('equipos.show', $equipo)
            ->with('success', "¡Bienvenido a {$equipo->nombre_equipo}!");
    }

    /**
     * Rechazar invitación
     */
    public function rechazar(Invitacion $invitacion)
    {
        if ($invitacion->invitado_id !== Auth::id()) {
            abort(403);
        }

        if ($invitacion->estado !== 'pendiente') {
            return back()->with('error', 'Esta invitación ya fue respondida.');
        }

        $invitacion->update(['estado' => 'rechazada', 'respondida_en' => now()]);

        Mail::to($invitacion->invitante)->queue(new InvitacionRechazadaMail($invitacion));

        return back()->with('success', 'Invitación rechazada.');
    }
}