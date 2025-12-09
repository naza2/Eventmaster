<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    public function store(Request $request, Equipo $equipo)
    {
        $this->authorize('update', $equipo);

        $request->validate([
            'buscar' => 'required|string',
            'rol' => 'required|in:programador,diseñador,analista_negocios,analista_datos,otro',
        ]);

        $usuario = User::where('matricula', $request->buscar)
                    ->orWhere('email', $request->buscar)
                    ->firstOrFail();

        // Prevenir que los jueces se unan a equipos
        if ($usuario->esJuez()) {
            return back()->withErrors(['buscar' => 'Los jueces no pueden ser miembros de equipos']);
        }

        if ($equipo->participantes()->where('user_id', $usuario->getKey())->exists()) {
            return back()->withErrors(['buscar' => 'Este usuario ya está en el equipo']);
        }

        $equipo->participantes()->create([
            'user_id' => $usuario->getKey(),
            'carrera_id' => $usuario->carrera_id,
            'num_control' => $usuario->matricula,
            'rol' => $request->rol,
        ]);

        return redirect()->route('equipos.show', $equipo)
                        ->with('success', '¡Miembro invitado correctamente!');
    }

    public function destroy(Equipo $equipo, User $user)
    {
        $this->authorize('update', $equipo);

        $participante = $equipo->participantes()->where('user_id', $user->getKey())->firstOrFail();
        $participante->delete();

        return redirect()->route('equipos.show', $equipo)
                        ->with('success', '¡Miembro eliminado correctamente!');
    }
}
