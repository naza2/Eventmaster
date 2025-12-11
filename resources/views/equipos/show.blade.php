@extends('layouts.master')

@section('title', $equipo->nombre_equipo)

@section('content')
<!-- HERO DEL EQUIPO -->
<section class="relative h-96 overflow-hidden">
    <div class="absolute inset-0">
        @if($equipo->evento->banner)
            <img src="{{
                filter_var($equipo->evento->banner, FILTER_VALIDATE_URL)
                    ? $equipo->evento->banner
                    : Storage::url($equipo->evento->banner)
            }}"
                 alt="{{ $equipo->evento->nombre }}"
                 class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 h-full flex items-end pb-16">
        <div class="flex items-end gap-10">
            <div class="relative flex-shrink-0">
                <div class="w-40 h-40 rounded-3xl overflow-hidden ring-8 ring-white/30 shadow-2xl bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center">
                    @if($equipo->logo)
                        <img src="{{
                            filter_var($equipo->logo, FILTER_VALIDATE_URL)
                                ? $equipo->logo
                                : Storage::url($equipo->logo)
                        }}"
                             alt="{{ $equipo->nombre_equipo }}"
                             class="w-full h-full object-cover">
                    @else
                        <span class="text-white text-6xl font-black">
                            {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                        </span>
                    @endif
                </div>

                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2">
                    <span class="px-6 py-3 rounded-full text-white font-black text-lg shadow-2xl
                                 {{ $equipo->estado === 'aprobado' ? 'bg-emerald-500' :
                                    ($equipo->estado === 'pendiente' ? 'bg-amber-500' : 'bg-red-600') }}">
                        {{ ucfirst($equipo->estado) }}
                    </span>
                </div>
            </div>

            <div class="text-white">
                <h1 class="text-5xl md:text-7xl font-black mb-4 leading-tight">
                    {{ $equipo->nombre_equipo }}
                </h1>

                <p class="text-3xl font-light mb-8 opacity-90">
                    {{ $equipo->nombre_proyecto }}
                </p>

                <div class="flex flex-wrap items-center gap-8 text-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-bold">{{ $equipo->evento->nombre }}</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-bold">
                            {{ $equipo->participantes->count() }} / {{ $equipo->evento->max_miembros }} miembros
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- BANNER DE CELEBRACIÓN SI ES GANADOR -->
@if($esGanador)
    <div class="bg-gradient-to-r from-yellow-400 via-orange-500 to-pink-500 py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-center gap-6 text-white">
                <div class="text-6xl animate-bounce">🏆</div>
                <div class="text-center">
                    <h2 class="text-4xl font-black mb-2">
                        ¡FELICIDADES! Lugar #{{ $esGanador->posicion }}
                    </h2>
                    <p class="text-xl font-bold">
                        @if($esGanador->posicion == 1)
                            🥇 Primer Lugar
                        @elseif($esGanador->posicion == 2)
                            🥈 Segundo Lugar
                        @elseif($esGanador->posicion == 3)
                            🥉 Tercer Lugar
                        @endif
                    </p>
                    @if($esGanador->premio)
                        <p class="text-lg mt-2">🎁 Premio: {{ $esGanador->premio }}</p>
                    @endif
                </div>
                <div class="text-6xl animate-bounce">🎉</div>
            </div>
        </div>
    </div>
@endif

<!-- DASHBOARD DEL EQUIPO -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <!-- NAVEGACIÓN DE PESTAÑAS -->
        <div class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl p-5 mb-12 border border-white/40">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
                <a href="{{ route('equipos.miembros', $equipo) }}"
                   class="px-5 py-4 rounded-2xl font-black text-sm transition-all duration-300
                          bg-white border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50">
                    Miembros
                </a>

                <a href="{{ route('equipos.proyecto', $equipo) }}"
                   class="px-5 py-4 rounded-2xl font-black text-sm transition-all duration-300
                          bg-white border-2 border-purple-600 text-purple-600 hover:bg-purple-50">
                    Proyecto
                </a>

                <a href="{{ route('equipos.avances', $equipo) }}"
                   class="px-5 py-4 rounded-2xl font-black text-sm transition-all duration-300
                          bg-white border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-50">
                    Avances
                </a>

                <a href="{{ route('equipos.repositorio', $equipo) }}"
                   class="px-5 py-4 rounded-2xl font-black text-sm transition-all duration-300
                          bg-white border-2 border-gray-600 text-gray-600 hover:bg-gray-100">
                    Repositorio
                </a>

                <a href="{{ route('equipos.asesoria', $equipo) }}"
                   class="px-5 py-4 rounded-2xl font-black text-sm transition-all duration-300
                          bg-white border-2 border-orange-600 text-orange-600 hover:bg-orange-50">
                    Asesoría
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- COLUMNA PRINCIPAL -->
            <div class="lg:col-span-2 space-y-12">
                <!-- RESUMEN DEL PROYECTO -->
                <div class="bg-white rounded-3xl shadow-xl p-10">
                    <h2 class="text-4xl font-black text-gray-900 mb-6">Descripción del proyecto</h2>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        {{ $equipo->descripcion_proyecto }}
                    </p>
                </div>

                <!-- ESTADÍSTICAS RÁPIDAS -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl p-6 text-white text-center">
                        <p class="text-5xl font-black mb-2">{{ $equipo->participantes->count() }}</p>
                        <p class="text-sm font-bold opacity-90">Miembros</p>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl p-6 text-white text-center">
                        <p class="text-5xl font-black mb-2">{{ $equipo->proyecto?->avances()->count() ?? 0 }}</p>
                        <p class="text-sm font-bold opacity-90">Avances</p>
                    </div>

                    <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl p-6 text-white text-center">
                        <p class="text-5xl font-black mb-2">{{ $equipo->asesorias->where('aprobado', true)->count() }}</p>
                        <p class="text-sm font-bold opacity-90">Asesores</p>
                    </div>

                    <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white text-center">
                        <p class="text-5xl font-black mb-2">{{ $equipo->calificaciones->count() }}</p>
                        <p class="text-sm font-bold opacity-90">Evaluaciones</p>
                    </div>
                </div>
            </div>

            <!-- SIDEBAR DERECHA -->
            <div class="space-y-10">
                <!-- INFORMACIÓN RÁPIDA -->
                <div class="bg-white rounded-3xl shadow-xl p-8">
                    <h3 class="text-2xl font-black text-gray-900 mb-8">Información rápida</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Evento</p>
                            <p class="text-xl font-black text-indigo-600">{{ $equipo->evento->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Estado del evento</p>
                            <p class="text-xl font-black text-purple-600 capitalize">{{ ucfirst($equipo->evento->estado) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Fecha límite</p>
                            <p class="text-xl font-black text-red-600">
                                {{ $equipo->evento->fecha_fin->format('d/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Días restantes</p>
                            <p class="text-4xl font-black text-orange-600">
                                {{ max(0, (int) now()->diffInDays($equipo->evento->fecha_fin, false)) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CALIFICACIONES -->
                @if($equipo->calificaciones->count() > 0 || $promedioCalificacion)
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl shadow-xl p-8 border-2 border-purple-200">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Calificaciones</h3>

                        @if($promedioCalificacion)
                            <div class="text-center mb-6 pb-6 border-b-2 border-purple-200">
                                <p class="text-sm text-gray-600 font-bold uppercase mb-2">Promedio General</p>
                                <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($promedioCalificacion, 1) }}
                                </p>
                                <p class="text-gray-500 text-sm mt-1">de 100 puntos</p>
                            </div>
                        @endif

                        @if($equipo->calificaciones->count() > 0)
                            <div class="space-y-3">
                                <p class="text-sm text-gray-600 font-bold uppercase mb-3">Por criterio:</p>
                                @foreach($equipo->calificaciones->groupBy('criterio.nombre') as $criterio => $calificaciones)
                                    <div class="bg-white rounded-xl p-4">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-bold text-gray-700">{{ $criterio }}</p>
                                            <p class="text-2xl font-black text-purple-600">
                                                {{ number_format($calificaciones->avg('puntaje'), 1) }}
                                            </p>
                                        </div>
                                        <div class="mt-2 bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-full h-2"
                                                 style="width: {{ ($calificaciones->avg('puntaje') / 100) * 100 }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- PRÓXIMOS PASOS -->
                <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl p-8 text-white">
                    <h3 class="text-2xl font-black mb-6">Próximos pasos</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 {{ $equipo->participantes->count() >= 2 ? 'text-green-300' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg">Completar equipo</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 {{ $equipo->proyecto ? 'text-green-300' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg">Completar información del proyecto</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 {{ $equipo->proyecto?->repositorio ? 'text-green-300' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg">Subir repositorio y demo</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 {{ $equipo->calificaciones->count() > 0 ? 'text-green-300' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg">Presentar al jurado</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
