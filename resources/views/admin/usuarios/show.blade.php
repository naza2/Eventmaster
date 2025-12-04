@extends('layouts.master')

@section('title', $usuario->name)

@section('content')
<section class="py-16">
    <div class="max-w-5xl mx-auto px-6">
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('admin.usuarios.index') }}" class="text-indigo-600 hover:text-indigo-700 font-bold">
                ← Volver a usuarios
            </a>
            <div class="flex gap-4">
                <a href="{{ route('admin.usuarios.edit', $usuario) }}{{ request()->query('tab') ? ('?tab=' . request()->query('tab')) : '' }}" class="px-6 py-3 bg-yellow-500 text-white font-bold rounded-xl hover:bg-yellow-600">
                    Editar
                </a>
                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline"
                      onsubmit="return confirm('¿Estás seguro?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Tarjeta de usuario -->
            <div class="bg-white rounded-3xl shadow-xl p-8 md:col-span-1">
                <div class="text-center mb-8">
                    <img src="{{ $usuario->foto_perfil ? Storage::url($usuario->foto_perfil) : asset('images/avatar.svg') }}" 
                         alt="{{ $usuario->name }}" class="w-32 h-32 rounded-full mx-auto object-cover mb-4 ring-4 ring-indigo-100">
                    <h2 class="text-2xl font-black text-gray-900">{{ $usuario->name }}</h2>
                    <p class="text-indigo-600 font-bold">{{ $usuario->email }}</p>
                </div>

                <div class="space-y-4 border-t border-gray-200 pt-6">
                    <div>
                        <p class="text-sm text-gray-600">Matrícula</p>
                        <p class="font-bold text-gray-900">{{ $usuario->matricula ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Carrera</p>
                        <p class="font-bold text-gray-900">{{ $usuario->carrera?->nombre ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Teléfono</p>
                        <p class="font-bold text-gray-900">{{ $usuario->telefono ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Roles</p>
                        <div class="flex flex-wrap gap-2">
                            @forelse($usuario->roles as $role)
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-bold rounded-full">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @empty
                                <span class="text-gray-500">Sin roles</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Equipos del usuario -->
            <div class="bg-white rounded-3xl shadow-xl p-8 md:col-span-2">
                <h3 class="text-2xl font-black text-gray-900 mb-6">Equipos del usuario</h3>
                
                @if($usuario->participantes->count() > 0)
                    <div class="space-y-4">
                        @foreach($usuario->participantes as $participante)
                            @php
                                $equipo = $participante->equipo;
                                $evento = $equipo->evento;
                            @endphp
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h4 class="text-xl font-black text-gray-900">{{ $equipo->nombre_equipo }}</h4>
                                        <p class="text-purple-600 font-bold">{{ $equipo->nombre_proyecto }}</p>
                                    </div>
                                    <div class="text-right">
                                        @if($participante->es_lider)
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full block mb-2">
                                                LÍDER
                                            </span>
                                        @endif
                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full">
                                            {{ ucfirst(str_replace('_', ' ', $participante->rol)) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-4 pt-4 border-t border-gray-200">
                                    <div>
                                        <p class="text-xs text-gray-600">Evento</p>
                                        <p class="font-bold text-gray-900">{{ Str::limit($evento->nombre, 20) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-600">Estado</p>
                                        <span class="px-2 py-1 text-xs font-bold rounded-full
                                            @if($equipo->estado === 'aprobado') bg-green-100 text-green-700
                                            @elseif($equipo->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ ucfirst($equipo->estado) }}
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('equipos.show', $equipo) }}" class="text-indigo-600 hover:text-indigo-700 font-bold text-sm">
                                            Ver equipo →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-600 text-lg">Este usuario no forma parte de ningún equipo</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
