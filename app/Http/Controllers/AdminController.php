<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

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

    public function usuariosStore(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:8|confirmed',
            'matricula'      => 'nullable|string|max:20|unique:users,matricula',
            'telefono'       => 'nullable|string|max:20',
            'carrera_id'     => 'required|exists:carreras,id',
            'roles'          => 'required|array|min:1',
            'roles.*'        => 'exists:roles,name',
            'fecha_nacimiento' => 'nullable|date',
            'sexo'           => 'nullable|in:M,F,Otro',
            'verificado'     => 'sometimes|boolean',
            'foto_perfil'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'foto_url'       => 'nullable|url|starts_with:https://,http://',
        ]);

        $usuario = User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'matricula'  => $request->matricula,
            'telefono'   => $request->telefono,
            'carrera_id' => $request->carrera_id,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'sexo'            => $request->sexo,
            'verificado'      => $request->boolean('verificado', $usuario->verificado),
        ]);

        // Manejo de foto (archivo o URL)
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

    public function usuariosUpdate(Request $request, User $usuario)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $usuario->id,
            'matricula'      => 'nullable|string|max:20|unique:users,matricula,' . $usuario->id,
            'telefono'       => 'nullable|string|max:20',
            'carrera_id'     => 'required|exists:carreras,id',
            'roles'          => 'required|array|min:1',
            'roles.*'        => 'exists:roles,name',
            'fecha_nacimiento' => 'nullable|date',
            'sexo'           => 'nullable|in:M,F,Otro',
            'verificado'     => 'sometimes|boolean',
            'foto_perfil'    => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'foto_url'       => 'nullable|url|starts_with:https://,http://',
        ]);

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

        // Manejo de foto (nueva imagen o nueva URL)
        if ($request->hasFile('foto_perfil')) {
            // Borrar la anterior si era archivo local
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
        // Opcional: eliminar foto si es local
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

    // ====================
    // CREAR EVENTO (store)
    // ====================
    public function eventosStore(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string|nullable',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after_or_equal:fecha_inicio',
            'max_miembros'  => 'nullable|integer|min:1|max:20',
            'estado'        => 'required|in:inscripcion,en_curso,finalizado',
            'banner'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120', // 5MB máx
            'banner_url'    => 'nullable|url|starts_with:https://,http://',
        ]);

        $evento = Evento::create([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin'    => $request->fecha_fin,
            'max_miembros'=> $request->max_miembros,
            'estado'       => $request->estado,
        ]);

        // Guardar banner (archivo o URL)
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

    // ====================
    // ACTUALIZAR EVENTO (update)
    // ====================
    public function eventosUpdate(Request $request, Evento $evento)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'descripcion'   => 'nullable|string',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'required|date|after_or_equal:fecha_inicio',
            'max_miembros'  => 'nullable|integer|min:1|max:20',
            'estado'        => 'required|in:inscripcion,en_curso,finalizado',
            'banner'        => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'banner_url'    => 'nullable|url|starts_with:https://,http://',
        ]);

        // Actualizar datos básicos
        $evento->update([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin'    => $request->fecha_fin,
            'max_miembros' => $request->max_miembros,
            'estado'       => $request->estado,
        ]);

        // Manejo del banner (subida o URL)
        if ($request->hasFile('banner')) {
            // Borrar banner anterior si es archivo local
            if ($evento->banner && !filter_var($evento->banner, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($evento->banner);
            }
            $path = $request->file('banner')->store('event_banners', 'public');
            $evento->banner = $path;
        }
        elseif ($request->filled('banner_url')) {
            // Si p.ej: si suben una nueva URL, reemplaza la anterior
            $evento->banner = $request->banner_url;
        }
        // Si no se sube nada → se mantiene el banner actual

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