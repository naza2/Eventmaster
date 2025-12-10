{{-- resources/views/equipos/miembros.blade.php --}}
@extends('layouts.master')

@section('title', 'Miembros de ' . $equipo->nombre_equipo)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Header del equipo -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 mb-10 border border-white/30">
            <div class="flex items-center gap-8">
                <div class="w-24 h-24 rounded-3xl overflow-hidden ring-8 ring-white/40 shadow-xl bg-gradient-to-br from-indigo-600 to-purple-600">
                    @if($equipo->logo)
                        <img src="{{ filter_var($equipo->logo, FILTER_VALIDATE_URL) ? $equipo->logo : Storage::url($equipo->logo) }}"
                             alt="{{ $equipo->nombre_equipo }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="flex items-center justify-center h-full text-white font-black text-4xl">
                            {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                        </span>
                    @endif
                </div>

                <div>
                    <h1 class="text-4xl font-black text-gray-900 mb-2">
                        {{ $equipo->nombre_equipo }}
                    </h1>
                    <p class="text-xl text-indigo-600 font-bold">{{ $equipo->nombre_proyecto }}</p>
                    <div class="flex items-center gap-4 mt-3 text-sm">
                        <span class="px-4 py-2 rounded-full font-bold
                                     {{ $equipo->estado === 'aprobado' ? 'bg-emerald-100 text-emerald-700' : 
                                        ($equipo->estado === 'pendiente' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($equipo->estado) }}
                        </span>
                        <span class="text-gray-600">
                            {{ $equipo->participantes->count() }} / {{ $equipo->evento->max_miembros }} miembros
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de miembros -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/30">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-black text-gray-900">Miembros del equipo</h2>
                @can('invite', $equipo)
                    <a href="{{ route('equipos.invitar', $equipo) }}"
                       class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                        + Invitar miembro
                    </a>
                @endcan
            </div>

            @if($equipo->participantes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($equipo->participantes as $miembro)
                        <div class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-200">
                            <div class="flex items-center gap-5">
                                <!-- Foto del miembro -->
                                <div class="relative">
                                    <img src="{{ 
                                        $miembro->user->foto_perfil 
                                            ? (filter_var($miembro->user->foto_perfil, FILTER_VALIDATE_URL) 
                                                ? $miembro->user->foto_perfil 
                                                : Storage::url($miembro->user->foto_perfil))
                                            : asset('images/avatar.svg')
                                    }}"
                                         alt="{{ $miembro->user->name }}"
                                         class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white shadow-xl">

                                    @if($miembro->es_lider)
                                        <div class="absolute -top-2 -right-2">
                                            <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-xl">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info del miembro -->
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h3 class="text-xl font-black text-gray-900">
                                            {{ $miembro->user->name }}
                                        </h3>
                                        @if($miembro->es_lider)
                                            <span class="px-3 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold rounded-full">LÍDER</span>
                                        @endif
                                    </div>
                                    <p class="text-indigo-600 font-bold">
                                        {{ ucfirst(str_replace('_', ' ', $miembro->rol)) }}
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        {{ $miembro->user->carrera?->nombre ?? 'Sin carrera' }}
                                    </p>
                                    <p class="text-gray-500 text-xs mt-1">
                                        {{ $miembro->user->matricula }}
                                    </p>
                                </div>
                            </div>

                            <!-- Acciones (solo líder puede eliminar) -->
                            @if(auth()->id() === $equipo->lider?->user_id && auth()->id() !== $miembro->user_id)
                                <div class="mt-5 pt-5 border-t border-gray-200 text-right">
                                    <form action="{{ route('participantes.destroy', $miembro) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('¿Eliminar a este miembro?')"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Eliminar del equipo
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-2xl text-gray-600 font-medium">El equipo aún no tiene miembros</p>
                </div>
            @endif
        </div>

        <!-- Botón volver -->
        <div class="mt-10 text-center">
            <a href="{{ route('equipos.show', $equipo) }}"
               class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:shadow-2xl transition">
                Volver al dashboard del equipo
            </a>
        </div>
    </div>
</div>
@endsection