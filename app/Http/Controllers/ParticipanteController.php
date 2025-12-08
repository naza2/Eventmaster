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
<<<<<<< HEAD

    public function destroy(Equipo $equipo, User $user)
    {
        $this->authorize('update', $equipo);

        $participante = $equipo->participantes()->where('user_id', $user->getKey())->firstOrFail();
        $participante->delete();

        return redirect()->route('equipos.show', $equipo)
                        ->with('success', '¡Miembro eliminado correctamente!');
    }
    
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $usuario->id,
            'matricula' => 'nullable|string|max:20|unique:users,matricula,' . $usuario->id,
            'telefono'  => 'nullable|string|max:20',
            'carrera'   => 'nullable|string|max:100',
            'role'      => 'required|string|exists:roles,name',
        ]);

        $usuario->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'matricula' => $request->filled('matricula') ? $request->matricula : null,
            'telefono'  => $request->filled('telefono') ? $request->telefono : null,
            'carrera'   => $request->filled('carrera') ? $request->carrera : null,
        ]);

        // Asignar rol único
        $usuario->syncRoles($request->role);

        return redirect()->route('admin.usuarios.show', $usuario)
                        ->with('success', 'Usuario actualizado correctamente');
    }
    
=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
}