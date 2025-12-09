<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Requests\EventoStoreRequest;
use App\Http\Requests\EventoUpdateRequest;

class AdminController extends Controller
{
    // ====================
    // USUARIOS
    // ====================

    public function usuariosIndex()
    {
        $usuarios = User::with('roles', 'carrera')->paginate(15);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function usuariosCreate()
    {
        $roles = Role::all();
        $carreras = \App\Models\Carrera::all();
        return view('admin.usuarios.create', compact('roles', 'carreras'));
    }

    public function usuariosStore(UsuarioStoreRequest $request)
    {

        $usuario = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'matricula'  => $request->matricula,
            'telefono'   => $request->telefono,
            'carrera_id' => $request->carrera_id,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'sexo'            => $request->sexo,
            'verificado'      => $request->boolean('verificado', false),
        ]);

        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('fotos_perfil', 'public');
            $usuario->foto_perfil = $path;
        } elseif ($request->filled('foto_url')) {
            $usuario->foto_perfil = $request->foto_url;
        }
        $usuario->save();

        $usuario->syncRoles($request->roles);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente');
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
        $carreras = \App\Models\Carrera::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles', 'carreras'));
    }

    public function usuariosUpdate(UsuarioUpdateRequest $request, User $usuario)
    {

        $usuario->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'matricula'  => $request->matricula,
            'telefono'   => $request->telefono,
            'carrera_id' => $request->carrera_id,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'sexo'            => $request->sexo,
            'verificado'      => $request->boolean('verificado', $usuario->verificado),
        ]);

        if ($request->hasFile('foto_perfil')) {
            if ($usuario->foto_perfil && !filter_var($usuario->foto_perfil, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($usuario->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('fotos_perfil', 'public');
            $usuario->foto_perfil = $path;
        } elseif ($request->filled('foto_url')) {
            $usuario->foto_perfil = $request->foto_url;
        }
        $usuario->save();

        $usuario->syncRoles($request->roles);

        return redirect()->route('admin.usuarios.show', $usuario)
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function usuariosDestroy(User $usuario)
    {
        if ($usuario->foto_perfil && !filter_var($usuario->foto_perfil, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($usuario->foto_perfil);
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }

    // ====================
    // EVENTOS
    // ====================

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

    public function eventosStore(EventoStoreRequest $request)
    {

        $evento = Evento::create([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin'    => $request->fecha_fin,
            'max_miembros'=> $request->max_miembros,
            'estado'       => $request->estado,
        ]);

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('event_banners', 'public');
            $evento->banner = $path;
        } elseif ($request->filled('banner_url')) {
            $evento->banner = $request->banner_url;
        }

        $evento->save();

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento creado exitosamente');
    }

    public function eventosUpdate(EventoUpdateRequest $request, Evento $evento)
    {

        $evento->update([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin'    => $request->fecha_fin,
            'max_miembros' => $request->max_miembros,
            'estado'       => $request->estado,
        ]);

        if ($request->hasFile('banner')) {
            if ($evento->banner && !filter_var($evento->banner, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($evento->banner);
            }
            $path = $request->file('banner')->store('event_banners', 'public');
            $evento->banner = $path;
        }
        elseif ($request->filled('banner_url')) {
            $evento->banner = $request->banner_url;
        }

        $evento->save();

        return redirect()->route('admin.eventos.show', $evento)
            ->with('success', 'Evento actualizado correctamente');
    }

    public function eventosDestroy(Evento $evento)
    {
        if ($evento->banner) {
            Storage::disk('public')->delete($evento->banner);
        }
        $evento->delete();

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento eliminado correctamente');
    }
}
