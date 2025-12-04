@extends('layouts.master')

@section('title', $evento->nombre)

@section('content')
<!-- HERO DEL EVENTO -->
<section class="relative h-96 md:h-screen max-h-screen overflow-hidden">
    <div class="absolute inset-0">
        @if($evento->banner)
            <img src="{{ Storage::url($evento->banner) }}" alt="{{ $evento->nombre }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600"></div>
        @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent pointer-events-none"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 h-full flex items-end pb-20">
        <div class="max-w-4xl">
            <div class="flex items-center gap-4 mb-6">
                @switch($evento->estado)
                    @case('inscripcion')
                        <span class="px-6 py-3 bg-green-500 text-white font-bold rounded-full shadow-2xl text-lg">Inscripción abierta</span>
                        @break
                    @case('en_curso')
                        <span class="px-6 py-3 bg-yellow-500 text-white font-bold rounded-full shadow-2xl text-lg">En curso</span>
                        @break
                    @case('finalizado')
                        <span class="px-6 py-3 bg-gray-600 text-white font-bold rounded-full shadow-2xl text-lg">Finalizado</span>
                        @break
                @endswitch
            </div>

            <h1 class="text-5xl md:text-8xl font-black text-white drop-shadow-2xl mb-6 leading-tight">
                {{ $evento->nombre }}
            </h1>

            <div class="flex flex-wrap items-center gap-8 text-white/90 text-lg">
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="font-bold">
                        {{ $evento->fecha_inicio->format('d/m/Y') }} → {{ $evento->fecha_fin->format('d/m/Y') }}
                    </span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span class="font-bold">{{ $evento->equipos_count ?? 0 }} equipos inscritos</span>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1h12v-1zm0 0h6v-1h-6v1z"/>
                    </svg>
                    <span class="font-bold">Máx. {{ $evento->max_miembros }} miembros por equipo</span>
                </div>
            </div>

            @auth
                @if($evento->estado === 'inscripcion')
                    <a href="{{ route('equipo.create', $evento) }}"
                       class="mt-10 inline-block px-12 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-green-500/50 transform hover:scale-110 transition-all duration-500 shadow-2xl">
                        Inscribir mi equipo
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}"
                   class="mt-10 inline-block px-12 py-6 bg-white text-indigo-700 font-black text-2xl rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500 shadow-2xl">
                    Inicia sesión para inscribirte
                </a>
            @endauth
        </div>
    </div>
</section>

<!-- CONTENIDO DEL EVENTO -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Columna principal -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Descripción -->
                <div class="bg-white rounded-3xl shadow-xl p-10">
                    <h2 class="text-4xl font-black text-gray-900 mb-8">Sobre el evento</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($evento->descripcion ?? 'Sin descripción disponible')) !!}
                    </div>
                </div>

                <!-- Bases y reglamento -->
                @if($evento->bases)
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl shadow-xl p-10 border border-indigo-100">
                        <h3 class="text-3xl font-black text-gray-900 mb-6">Bases del concurso</h3>
                        <div class="prose prose-lg">
                            {!! $evento->bases !!}
                        </div>
                    </div>
                @endif

                <!-- Equipos participantes -->
                <div class="bg-white rounded-3xl shadow-xl p-10">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-4xl font-black text-gray-900">
                            Equipos participantes ({{ $evento->equipos_count ?? 0 }})
                        </h2>
                        @can('create', \App\Models\Equipo::class)
                            <a href="{{ route('equipo.create', $evento) }}"
                               class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                + Crear equipo
                            </a>
                        @endcan
                    </div>

                    @if($evento->equipos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($evento->equipos as $equipo)
                                <a href="{{ route('equipos.show', $equipo) }}"
                                   class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border border-gray-200">
                                    <div class="flex items-center gap-5 mb-6">
                                        @if($equipo->logo)
                                            <img src="{{ Storage::url($equipo->logo) }}" alt="{{ $equipo->nombre_equipo }}" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white shadow-xl">
                                        @else
                                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white text-3xl font-black shadow-xl">
                                                {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-2xl font-black text-gray-900">{{ $equipo->nombre_equipo }}</h3>
                                            <p class="text-lg text-indigo-600 font-bold">{{ $equipo->nombre_proyecto }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">
                                            {{ $equipo->participantes_count ?? 0 }} miembros
                                        </span>
                                        <span class="px-4 py-2 rounded-full text-sm font-bold
                                            @if($equipo->estado === 'aprobado') bg-green-100 text-green-700
                                            @elseif($equipo->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ ucfirst($equipo->estado) }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <p class="text-2xl text-gray-600">Aún no hay equipos inscritos</p>
                            <p class="text-lg text-gray-500 mt-4">¡Sé el primero en crear uno!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar derecha -->
            <div class="space-y-10">
                <!-- Información rápida -->
                <div class="bg-white rounded-3xl shadow-xl p-8">
                    <h3 class="text-2xl font-black text-gray-900 mb-6">Información del evento</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Fechas</p>
                            <p class="text-xl font-black text-indigo-600">
                                {{ $evento->fecha_inicio->format('d/m/Y') }} - {{ $evento->fecha_fin->format('d/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Estado</p>
                            <p class="text-xl font-black text-purple-600">
                                {{ ucfirst(str_replace('_', ' ', $evento->estado)) }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Máximo por equipo</p>
                            <p class="text-xl font-black text-indigo-600">{{ $evento->max_miembros }} miembros</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Equipos inscritos</p>
                            <p class="text-4xl font-black text-purple-600">{{ $evento->equipos_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Jueces -->
                @if($evento->jueces->count() > 0)
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl shadow-xl p-8 border border-purple-100">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Jurado oficial</h3>
                        <div class="space-y-6">
                            @foreach($evento->jueces as $juez)
                                <div class="flex items-center gap-5">
                                    <img src="{{ $juez->user->foto_perfil ? Storage::url($juez->user->foto_perfil) : asset('images/avatar.svg') }}"
                                         alt="{{ $juez->user->name }}"
                                         class="w-16 h-16 rounded-full ring-4 ring-white shadow-xl object-cover">
                                    <div>
                                        <p class="font-bold text-gray-900 text-lg">{{ $juez->user->name }}</p>
                                        <p class="text-sm text-purple-700 font-medium">Juez oficial</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- CTA final -->
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-10 text-white text-center">
                    <h3 class="text-3xl font-black mb-6">¿Listo para participar?</h3>
                    <p class="text-xl mb-8 opacity-90">No dejes pasar esta oportunidad</p>
                    @auth
                        @if($evento->estado === 'inscripcion')
                            <a href="{{ route('equipo.create', $evento) }}"
                               class="inline-block px-12 py-6 bg-white text-indigo-700 font-black text-2xl rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                                Crear mi equipo ahora
                            </a>
                        @else
                            <p class="text-2xl font-bold">Inscripciones cerradas</p>
                        @endif
                    @else
                        <a href="{{ route('register') }}"
                           class="inline-block px-12 py-6 bg-white text-indigo-700 font-black text-2xl rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                            Registrarme para participar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
@endsection