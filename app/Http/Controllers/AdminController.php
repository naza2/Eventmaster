<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
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

    // USUARIOS
    public function usuariosIndex()
    {
        $usuarios = User::with('roles', 'carrera')->paginate(15);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function usuariosShow(User $usuario)
    {
        $usuario->load('roles', 'carrera', 'participantes.equipo.evento');
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function usuariosEdit(User $usuario)
    {
        $roles = Role::all();
        $usuario->load('roles');
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function usuariosUpdate(Request $request, User $usuario)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->getKey(),
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $usuario->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if (isset($data['roles'])) {
            // Sincronizar roles por nombre (el formulario envía los nombres de rol)
            $usuario->syncRoles($data['roles']);
        }

        // Después de actualizar, regresar al listado de usuarios
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function usuariosDestroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado');
    }

    // EVENTOS
    public function eventosIndex()
    {
        $eventos = Evento::withCount('equipos')->orderByDesc('fecha_inicio')->paginate(15);
        return view('admin.eventos.index', compact('eventos'));
    }

    public function eventosShow(Evento $evento)
    {
        $evento->load('equipos.participantes.user', 'jueces.user', 'criterios');
        return view('admin.eventos.show', compact('evento'));
    }

    public function eventosEdit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function eventosUpdate(Request $request, Evento $evento)
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

        $evento->update($data);

        // Después de actualizar, regresar al listado de eventos
        return redirect()->route('admin.eventos.index')->with('success', 'Evento actualizado correctamente');
    }

    public function eventosDestroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('admin.eventos.index')->with('success', 'Evento eliminado');
    }
}
