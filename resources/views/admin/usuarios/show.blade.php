{{-- resources/views/admin/usuarios/show.blade.php --}}
@extends('layouts.master')

@section('title', $usuario->name . ' - Perfil')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Header con acciones -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-10">
            <a href="{{ route('admin.usuarios.index') }}"
               class="inline-flex items-center gap-3 px-6 py-3 bg-white/80 backdrop-blur-xl text-indigo-600 font-bold text-lg rounded-2xl hover:bg-indigo-50 transition shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a usuarios
            </a>

            <div class="flex gap-4">
                <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                   class="px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-black text-lg rounded-2xl shadow-xl hover:shadow-amber-500/50 transform hover:scale-105 transition">
                    Editar Usuario
                </a>

                <button type="button"
                        onclick="confirm('¿Estás 100% seguro de eliminar a {{ $usuario->name }}?') && document.getElementById('delete-form').submit()"
                        class="px-8 py-4 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-black text-lg rounded-2xl shadow-xl hover:shadow-red-500/50 transform hover:scale-105 transition">
                    Eliminar
                </button>

                <form id="delete-form" action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="hidden">
                    @csrf @method('DELETE')
                </form>
            </div>
        </div>

        <!-- Grid principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Tarjeta de perfil -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8">
                <div class="text-center">
                    <div class="relative inline-block mb-6">
                        <img src="{{ $usuario->foto_perfil 
                            ? (filter_var($usuario->foto_perfil, FILTER_VALIDATE_URL) 
                                ? $usuario->foto_perfil 
                                : Storage::url($usuario->foto_perfil))
                            : asset('images/avatar.svg') }}"
                             alt="{{ $usuario->name }}"
                             class="w-40 h-40 rounded-full object-cover ring-8 ring-purple-100 shadow-2xl">

                        @if($usuario->verificado)
                            <div class="absolute bottom-2 right-2">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center shadow-xl">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>

                    <h1 class="text-3xl font-black text-gray-900 mb-2">{{ $usuario->name }}</h1>
                    <p class="text-purple-600 font-bold text-lg">{{ $usuario->email }}</p>

                    @if($usuario->matricula)
                        <p class="text-gray-600 mt-3">
                            <span class="font-bold">Matrícula:</span> {{ $usuario->matricula }}
                        </p>
                    @endif
                </div>

                <div class="mt-8 space-y-5 border-t-2 border-gray-100 pt-8">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Carrera</span>
                        <span class="font-bold text-gray-900">{{ $usuario->carrera?->nombre ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Teléfono</span>
                        <span class="font-bold text-gray-900">{{ $usuario->telefono ?? '—' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Fecha de nacimiento</span>
                        <span class="font-bold text-gray-900">
                            {{ $usuario->fecha_nacimiento?->format('d/m/Y') ?? '—' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Género</span>
                        <span class="font-bold text-gray-900">
                            {{ $usuario->sexo ? ['M' => 'Masculino', 'F' => 'Femenino', 'Otro' => 'Otro'][$usuario->sexo] : '—' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 font-medium">Estado</span>
                        <span class="px-4 py-2 rounded-full text-white font-bold text-sm
                                     {{ $usuario->verificado ? 'bg-emerald-500' : 'bg-gray-400' }}">
                            {{ $usuario->verificado ? 'Verificado' : 'No verificado' }}
                        </span>
                    </div>
                </div>

                <!-- Roles -->
                <div class="mt-8">
                    <p class="text-center text-gray-600 font-medium mb-4">Roles asignados</p>
                    <div class="flex flex-wrap justify-center gap-3">
                        @forelse($usuario->roles as $role)
                            <span class="px-5 py-2 rounded-full text-white font-black text-sm shadow-lg
                                         {{ $role->name === 'administrador' ? 'bg-gradient-to-r from-indigo-600 to-purple-600' : 
                                            'bg-gradient-to-r from-emerald-500 to-teal-600' }}">
                                {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                            </span>
                        @empty
                            <span class="text-gray-500 italic">Sin roles</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Equipos del usuario -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8">
                    <h3 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-4">
                        Equipos inscritos
                        <span class="text-5xl text-purple-600 font-black">
                            {{ $usuario->participantes->count() }}
                        </span>
                    </h3>

                    @if($usuario->participantes->count() > 0)
                        <div class="space-y-5">
                            @foreach($usuario->participantes as $participante)
                                @php
                                    $equipo = $participante->equipo;
                                    $evento = $equipo->evento;
                                @endphp
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 hover:from-purple-50 hover:to-pink-50 
                                            rounded-2xl p-6 border border-gray-200 hover:border-purple-300 
                                            transition-all duration-300 shadow-md hover:shadow-xl">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div>
                                            <h4 class="text-2xl font-black text-gray-900">
                                                {{ $equipo->nombre_equipo }}
                                            </h4>
                                            <p class="text-purple-600 font-bold text-lg mt-1">
                                                {{ $equipo->nombre_proyecto }}
                                            </p>
                                            <p class="text-gray-600 mt-2">
                                                <span class="font-medium">Evento:</span> {{ $evento->nombre }}
                                            </p>
                                        </div>

                                        <div class="flex flex-col items-end gap-3">
                                            @if($participante->es_lider)
                                                <span class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-amber-500 text-white font-black text-sm rounded-full shadow-lg">
                                                    LÍDER DEL EQUIPO
                                                </span>
                                            @endif

                                            <div class="flex items-center gap-3">
                                                <span class="px-4 py-2 rounded-full text-white font-bold text-sm shadow
                                                             {{ $equipo->estado === 'aprobado' ? 'bg-emerald-500' : 
                                                                ($equipo->estado === 'pendiente' ? 'bg-amber-500' : 'bg-red-500') }}">
                                                    {{ ucfirst($equipo->estado) }}
                                                </span>

                                                <a href="{{ route('equipos.show', $equipo) }}"
                                                   class="px-5 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg transform hover:scale-105 transition">
                                                    Ver equipo
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-xl text-gray-600 font-medium">
                                Este usuario aún no forma parte de ningún equipo
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
