{{-- resources/views/eventos/show.blade.php --}}
@extends('layouts.master')

@section('title', $evento->nombre)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">

    <!-- HERO COMPACTO Y ELEGANTE -->
    <section class="relative h-96 overflow-hidden">
        <div class="absolute inset-0">
            @if($evento->banner)
                <img src="{{ filter_var($evento->banner, FILTER_VALIDATE_URL) ? $evento->banner : Storage::url($evento->banner) }}"
                     alt="{{ $evento->nombre }}"
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 h-full flex items-end pb-12">
            <div class="max-w-4xl">
                <!-- Estado -->
                <div class="mb-4">
                    @switch($evento->estado)
                        @case('inscripcion')
                            <span class="px-6 py-3 bg-emerald-500 text-white font-black text-sm rounded-full shadow-xl">
                                Inscripción abierta
                            </span>
                            @break
                        @case('en_curso')
                            <span class="px-6 py-3 bg-amber-500 text-white font-black text-sm rounded-full shadow-xl">
                                En curso
                            </span>
                            @break
                        @case('finalizado')
                            <span class="px-6 py-3 bg-gray-600 text-white font-black text-sm rounded-full shadow-xl">
                                Finalizado
                            </span>
                            @break
                    @endswitch
                </div>

                <!-- Título -->
                <h1 class="text-5xl md:text-7xl font-black text-white drop-shadow-2xl mb-4 leading-tight">
                    {{ $evento->nombre }}
                </h1>

                <!-- Info rápida -->
                <div class="flex flex-wrap items-center gap-6 text-white/90 text-base">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-bold">
                            {{ $evento->fecha_inicio->format('d/m/Y') }} → {{ $evento->fecha_fin->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-bold">{{ $evento->equipos_count ?? 0 }} equipos</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1h12v-1zm0 0h6v-1h-6v1z"/>
                        </svg>
                        <span class="font-bold">Máx. {{ $evento->max_miembros }} por equipo</span>
                    </div>
                </div>

                <!-- CTA -->
                @auth
                    @if($evento->estado === 'inscripcion')
                        <a href="{{ route('equipo.create', $evento) }}"
                           class="mt-8 inline-flex items-center gap-4 px-10 py-5 bg-gradient-to-r from-emerald-500 to-teal-600 
                                  hover:from-emerald-600 hover:to-teal-700 text-white font-black text-xl rounded-3xl 
                                  shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-300">
                            Inscribir equipo
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                       class="mt-8 inline-block px-10 py-5 bg-white text-indigo-700 font-black text-xl rounded-3xl 
                              hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                        Inicia sesión para participar
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- CONTENIDO -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <!-- Columna principal -->
                <div class="lg:col-span-2 space-y-10">

                    <!-- Descripción -->
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/30">
                        <h2 class="text-3xl font-black text-gray-900 mb-6">Sobre el evento</h2>
                        <div class="prose prose-lg text-gray-700 leading-relaxed">
                            {!! $evento->descripcion ? nl2br(e($evento->descripcion)) : '<p class="text-gray-500 italic">Sin descripción disponible</p>' !!}
                        </div>
                    </div>

                    <!-- Equipos -->
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/30">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-3xl font-black text-gray-900">
                                Equipos ({{ $evento->equipos_count ?? 0 }})
                            </h2>
                            @can('create', \App\Models\Equipo::class)
                                <a href="{{ route('equipo.create', $evento) }}"
                                   class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                    + Crear equipo
                                </a>
                            @endcan
                        </div>

                        @if($evento->equipos->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($evento->equipos as $equipo)
                                    <a href="{{ route('equipos.show', $equipo) }}"
                                       class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 
                                              hover:shadow-xl hover:-translate-y-2 transition-all duration-300 
                                              border border-gray-200">
                                        <div class="flex items-center gap-4 mb-5">
                                            @if($equipo->logo)
                                                <img src="{{ filter_var($equipo->logo, FILTER_VALIDATE_URL) ? $equipo->logo : Storage::url($equipo->logo) }}"
                                                     alt="{{ $equipo->nombre_equipo }}"
                                                     class="w-16 h-16 rounded-2xl object-cover ring-4 ring-white shadow-xl">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl 
                                                            flex items-center justify-center text-white text-2xl font-black shadow-xl">
                                                    {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="text-xl font-black text-gray-900 group-hover:text-indigo-600 transition">
                                                    {{ $equipo->nombre_equipo }}
                                                </h3>
                                                <p class="text-indigo-600 font-bold">{{ $equipo->nombre_proyecto }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-600">
                                                {{ $equipo->participantes->count() }}/{{ $evento->max_miembros }} miembros
                                            </span>
                                            <span class="px-4 py-2 rounded-full font-bold
                                                 {{ $equipo->estado === 'aprobado' ? 'bg-emerald-100 text-emerald-700' : 
                                                    ($equipo->estado === 'pendiente' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                                {{ ucfirst($equipo->estado) }}
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16 text-gray-500">
                                <p class="text-2xl font-bold">Aún no hay equipos inscritos</p>
                                <p class="mt-3">¡Sé el primero!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Resumen -->
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/30">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Resumen</h3>
                        <div class="space-y-6 text-center">
                            <div>
                                <p class="text-5xl font-black text-purple-600">
                                    {{ $evento->equipos_count ?? 0 }}
                                </p>
                                <p class="text-gray-600 font-medium">Equipos</p>
                            </div>
                            <div>
                                <p class="text-5xl font-black text-indigo-600">
                                    {{ $evento->equipos->sum(fn($e) => $e->participantes->count()) }}
                                </p>
                                <p class="text-gray-600 font-medium">Participantes</p>
                            </div>
                            <div>
                                <p class="text-5xl font-black text-emerald-600">
                                    {{ $evento->jueces->count() }}
                                </p>
                                <p class="text-gray-600 font-medium">Jueces</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA final -->
                    @auth
                        @if($evento->estado === 'inscripcion')
                            <a href="{{ route('equipo.create', $evento) }}"
                               class="block text-center px-10 py-8 bg-gradient-to-r from-emerald-500 to-teal-600 
                                      hover:from-emerald-600 hover:to-teal-700 text-white font-black text-2xl 
                                      rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-300">
                                Inscribir mi equipo ahora
                            </a>
                        @else
                            <div class="text-center px-10 py-8 bg-gray-200 text-gray-700 font-black text-xl rounded-3xl">
                                Inscripciones cerradas
                            </div>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                           class="block text-center px-10 py-8 bg-white text-indigo-700 font-black text-2xl 
                                  rounded-3xl shadow-2xl hover:shadow-indigo-500/50 transform hover:scale-105 transition-all duration-300">
                            Registrarme para participar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
</div>
@endsection