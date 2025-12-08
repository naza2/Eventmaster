{{-- resources/views/admin/eventos/show.blade.php --}}
@extends('layouts.master')

@section('title', $evento->nombre)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Header con banner PREMIUM -->
        <div class="relative h-96 rounded-3xl overflow-hidden shadow-2xl mb-12 ring-8 ring-white/50">
                <img src="{{ 
            $evento->banner 
                ? (filter_var($evento->banner, FILTER_VALIDATE_URL) 
                    ? $evento->banner 
                    : Storage::url($evento->banner))
                : '' 
        }}" 
            alt="{{ $evento->nombre }}"
            class="w-full h-full object-cover {{ $evento->banner ? '' : 'hidden' }}">

        <div class="{{ $evento->banner ? 'hidden' : 'w-full h-full' }} 
            bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 
            flex items-center justify-center">
            <p class="text-white text-8xl font-black opacity-70">
                {{ Str::upper(substr($evento->nombre, 0, 2)) }}
            </p>
        </div>

            <!-- Overlay con info del evento -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent">
                <div class="absolute bottom-0 left-0 right-0 p-10 text-white">
                    <div class="max-w-4xl">
                        <h1 class="text-7xl font-black mb-6 drop-shadow-2xl">
                            {{ $evento->nombre }}
                        </h1>
                        <div class="flex flex-wrap gap-10 text-xl">
                            <div class="flex items-center gap-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="text-sm opacity-80">Inicio</p>
                                    <p class="text-3xl font-black">{{ $evento->fecha_inicio->format('d M Y - H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-sm opacity-80">Fin</p>
                                    <p class="text-3xl font-black">{{ $evento->fecha_fin->format('d M Y - H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               

                <!-- Estado del evento (esquina superior derecha) -->
                <div class="absolute top-8 right-8">
                    @switch($evento->estado)
                        @case('inscripcion')
                            <span class="px-8 py-4 bg-emerald-500 text-white font-black text-xl rounded-full shadow-2xl">
                                Inscripción abierta
                            </span>
                            @break
                        @case('en_curso')
                            <span class="px-8 py-4 bg-amber-500 text-white font-black text-xl rounded-full shadow-2xl">
                                En curso
                            </span>
                            @break
                        @case('finalizado')
                            <span class="px-8 py-4 bg-gray-600 text-white font-black text-xl rounded-full shadow-2xl">
                                Finalizado
                            </span>
                            @break
                    @endswitch
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex flex-wrap gap-4 mb-12">
            <a href="{{ route('admin.eventos.index') }}"
               class="inline-flex items-center gap-3 px-8 py-4 bg-white/90 backdrop-blur-xl text-indigo-600 font-black text-xl rounded-2xl hover:bg-indigo-50 transition shadow-lg">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>

            <a href="{{ route('admin.eventos.edit', $evento) }}"
               class="px-10 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-black text-xl rounded-2xl shadow-xl hover:shadow-amber-500/50 transform hover:scale-105 transition">
                Editar Evento
            </a>

            <button type="button"
                    onclick="confirm('¿Eliminar este evento y TODOS sus equipos?') && document.getElementById('delete-form').submit()"
                    class="px-10 py-4 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-black text-xl rounded-2xl shadow-xl hover:shadow-red-500/50 transform hover:scale-105 transition">
                Eliminar Evento
            </button>

            <form id="delete-form" action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" class="hidden">
                @csrf @method('DELETE')
            </form>
        </div>

        <!-- Grid principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <!-- Información + Equipos -->
            <div class="lg:col-span-2 space-y-10">

                <!-- Información del evento -->
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-10">
                    <h2 class="text-4xl font-black text-gray-900 mb-8">Información del Evento</h2>

                    <div class="grid md:grid-cols-2 gap-8 mb-10">
                        <div>
                            <p class="text-lg text-gray-600 font-bold mb-3">Máximo de miembros por equipo</p>
                            <p class="text-4xl font-black text-purple-600">
                                {{ $evento->max_miembros ?? 'Sin límite' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-lg text-gray-600 font-bold mb-3">Descripción</p>
                            <p class="text-gray-700 leading-relaxed text-lg">
                                {{ $evento->descripcion ?? 'Sin descripción disponible' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Equipos participantes -->
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-10">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-4xl font-black text-gray-900">
                            Equipos participantes
                        </h2>
                        <span class="text-6xl font-black text-purple-600">
                            {{ $evento->equipos->count() }}
                        </span>
                    </div>

                    @if($evento->equipos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($evento->equipos as $equipo)
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 hover:from-purple-50 hover:to-pink-50 
                                            rounded-2xl p-8 border-2 border-gray-200 hover:border-purple-300 
                                            transition-all duration-300 shadow-lg hover:shadow-2xl">
                                    <div class="flex items-start justify-between mb-6">
                                        <div>
                                            <h3 class="text-2xl font-black text-gray-900 mb-2">
                                                {{ $equipo->nombre_equipo }}
                                            </h3>
                                            <p class="text-xl text-purple-600 font-bold">
                                                {{ $equipo->nombre_proyecto }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            @if($equipo->participantes->where('es_lider', true)->first())
                                                <span class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-amber-500 text-white font-black text-sm rounded-full shadow-lg">
                                                    LÍDER
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Miembros</span>
                                            <span class="text-2xl font-black text-indigo-600">
                                                {{ $equipo->participantes->count() }}/{{ $evento->max_miembros }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Estado</span>
                                            <span class="px-5 py-2 rounded-full text-white font-bold
                                                         {{ $equipo->estado === 'aprobado' ? 'bg-emerald-500' : 
                                                            ($equipo->estado === 'pendiente' ? 'bg-amber-500' : 'bg-red-500') }}">
                                                {{ ucfirst($equipo->estado) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-6 pt-6 border-t-2 border-gray-200">
                                        <a href="{{ route('equipos.show', $equipo) }}"
                                           class="inline-flex items-center gap-3 text-indigo-600 hover:text-indigo-700 font-black text-lg hover:underline">
                                            Ver equipo completo
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-20">
                            <svg class="w-32 h-32 text-gray-300 mx-auto mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-2xl text-gray-600 font-bold">
                                Aún no hay equipos inscritos
                            </p>
                            <p class="text-gray-500 mt-4">
                                Los equipos aparecerán aquí cuando se inscriban
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar con resumen -->
            <div class="space-y-8">
                <!-- Resumen rápido -->
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-8">
                    <h3 class="text-3xl font-black text-gray-900 mb-8 text-center">
                        Resumen del Evento
                    </h3>

                    <div class="space-y-8">
                        <div class="text-center">
                            <p class="text-6xl font-black text-purple-600 mb-3">
                                {{ $evento->equipos->count() }}
                            </p>
                            <p class="text-xl text-gray-700 font-bold">Equipos inscritos</p>
                        </div>

                        <div class="text-center">
                            <p class="text-6xl font-black text-emerald-600 mb-3">
                                {{ $evento->equipos->sum(fn($e) => $e->participantes->count()) }}
                            </p>
                            <p class="text-xl text-gray-700 font-bold">Participantes totales</p>
                        </div>

                        <div class="text-center">
                            <p class="text-6xl font-black text-indigo-600 mb-3">
                                {{ $evento->jueces->count() }}
                            </p>
                            <p class="text-xl text-gray-700 font-bold">Jueces asignados</p>
                        </div>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl p-8 text-white shadow-2xl">
                    <h4 class="text-2xl font-black mb-6 text-center">
                        Acciones rápidas
                    </h4>
                    <div class="space-y-4">
                        <a href="{{ route('admin.eventos.edit', $evento) }}"
                           class="block text-center py-4 bg-white/20 hover:bg-white/30 rounded-2xl font-bold text-xl transition">
                            Editar evento
                        </a>
                        <a href="#" class="block text-center py-4 bg-white/20 hover:bg-white/30 rounded-2xl font-bold text-xl transition">
                            Gestionar jueces
                        </a>
                        <a href="#" class="block text-center py-4 bg-white/20 hover:bg-white/30 rounded-2xl font-bold text-xl transition">
                            Ver criterios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
