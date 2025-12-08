<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
<<<<<<< HEAD
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'role' => 'required|string|exists:roles,name', // ahora es un solo rol
            // otros campos...
        ]);

        DB::transaction(function () use ($request, $usuario) {
            $usuario->update($request->only(['name', 'email', /* otros campos */]));

            // Eliminar todos los roles anteriores y asignar el nuevo
            $usuario->syncRoles([]);                    // quita todos
            $usuario->assignRole($request->role);        // asigna el seleccionado
        });

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('usuarios.index');
    }

=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    public function asesoriasRecibidas()
    {
        return $this->hasMany(Asesoria::class, 'user_id');
    }
}