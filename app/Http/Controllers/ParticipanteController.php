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

        // Buscar usuario por matrícula o email
        $usuario = User::where('matricula', $request->buscar)
                    ->orWhere('email', $request->buscar)
                    ->firstOrFail();

        // Validar que no esté ya en el equipo
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
}