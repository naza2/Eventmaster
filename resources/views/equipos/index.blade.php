<<<<<<< HEAD
{{-- resources/views/equipos/mis-equipos.blade.php --}}
=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
@extends('layouts.master')

@section('title', 'Mis Equipos')

@section('content')
<<<<<<< HEAD
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">

    <!-- HERO PREMIUM -->
    <section class="relative overflow-hidden py-32">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 opacity-95"></div>
        <div class="absolute inset-0 bg-black opacity-40"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 text-center text-white">
            <h1 class="text-6xl md:text-8xl font-black mb-8 tracking-tight">
                Mis Equipos
            </h1>
            <p class="text-2xl md:text-3xl font-light max-w-4xl mx-auto opacity-95 leading-relaxed">
                Todos tus proyectos, hackathons y competiciones en un solo lugar
            </p>

            <!-- Estadísticas con efecto glass -->
            <div class="mt-16 flex flex-wrap justify-center gap-8">
                <div class="bg-white/20 backdrop-blur-xl rounded-3xl px-10 py-8 shadow-2xl border border-white/30">
                    <p class="text-6xl font-black">{{ auth()->user()->participantes()->count() }}</p>
                    <p class="text-xl opacity-90 mt-2">Equipos activos</p>
                </div>
                <div class="bg-white/20 backdrop-blur-xl rounded-3xl px-10 py-8 shadow-2xl border border-white/30">
                    <p class="text-6xl font-black text-yellow-300">
                        {{ auth()->user()->participantes()->where('es_lider', true)->count() }}
                    </p>
                    <p class="text-xl opacity-90 mt-2">Líder de equipo</p>
                </div>
                <div class="bg-white/20 backdrop-blur-xl rounded-3xl px-10 py-8 shadow-2xl border border-white/30">
                    <p class="text-6xl font-black text-emerald-300">
                        {{ auth()->user()->participantes()->where('rol', 'like', '%desarrollador%')->count() }}
                    </p>
                    <p class="text-xl opacity-90 mt-2">Proyectos como dev</p>
                </div>
            </div>
        </div>
    </section>

    <!-- LISTA DE EQUIPOS -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-16">
                <div>
                    <h2 class="text-5xl font-black text-gray-900">
                        Tus equipos actuales
                    </h2>
                    <p class="text-xl text-gray-600 mt-4">
                        Participas en <span class="font-black text-purple-600">
                            {{ auth()->user()->participantes()->count() }}
                        </span> {{ Str::plural('equipo', auth()->user()->participantes()->count()) }}
                    </p>
                </div>

                <a href="{{ route('eventos.index') }}"
                   class="inline-flex items-center gap-4 px-10 py-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-2xl rounded-3xl shadow-2xl hover:shadow-purple-500/50 transform hover:scale-105 transition-all duration-300 group">
                    <svg class="w-10 h-10 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                    Inscribirme en otro evento
                </a>
            </div>

            @if(auth()->user()->participantes()->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
                    @foreach(auth()->user()->participantes()->with('equipo.evento')->latest()->get() as $participante)
                        @php
                            $equipo = $participante->equipo;
                            $evento = $equipo->evento;
                        @endphp

                        <a href="{{ route('equipos.show', $equipo) }}"
                           class="group block bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-3xl transform hover:-translate-y-6 transition-all duration-500 border border-gray-100">

                            <!-- Banner del evento -->
                            <div class="relative h-56">
                                @if($evento->banner)
                                    <img src="{{ filter_var($evento->banner, FILTER_VALIDATE_URL) ? $evento->banner : Storage::url($evento->banner) }}"
                                         alt="{{ $evento->nombre }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600"></div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                                <!-- Estado del evento -->
                                <div class="absolute top-6 right-6">
                                    @switch($evento->estado)
                                        @case('inscripcion')
                                            <span class="px-5 py-3 bg-emerald-500 text-white font-black text-sm rounded-full shadow-xl">
                                                Inscripción
                                            </span>
                                            @break
                                        @case('en_curso')
                                            <span class="px-5 py-3 bg-amber-500 text-white font-black text-sm rounded-full shadow-xl">
                                                En curso
                                            </span>
                                            @break
                                        @case('finalizado')
                                            <span class="px-5 py-3 bg-gray-600 text-white font-black text-sm rounded-full shadow-xl">
                                                Finalizado
                                            </span>
                                            @break
                                    @endswitch
                                </div>

                                <!-- Nombre del evento -->
                                <div class="absolute bottom-6 left-6">
                                    <p class="text-3xl font-black text-white drop-shadow-2xl">
                                        {{ $evento->nombre }}
                                    </p>
                                </div>
                            </div>

                            <!-- Contenido del equipo -->
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-5">
                                        @if($equipo->logo)
                                            <img src="{{ filter_var($equipo->logo, FILTER_VALIDATE_URL) ? $equipo->logo : Storage::url($equipo->logo) }}"
                                                 alt="{{ $equipo->nombre_equipo }}"
                                                 class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white shadow-2xl">
                                        @else
                                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center text-white text-3xl font-black shadow-2xl">
                                                {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                                            </div>
                                        @endif

                                        <div>
                                            <h3 class="text-2xl font-black text-gray-900 group-hover:text-purple-600 transition">
                                                {{ $equipo->nombre_equipo }}
                                            </h3>
                                            <p class="text-xl font-bold text-purple-600">
                                                {{ $equipo->nombre_proyecto }}
                                            </p>
                                        </div>
                                    </div>

                                    @if($participante->es_lider)
                                        <div class="px-5 py-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-black rounded-full text-sm shadow-xl">
                                            LÍDER
                                        </div>
                                    @endif
                                </div>

                                <!-- Info rápida -->
                                <div class="space-y-5 bg-gray-50 rounded-2xl p-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600 font-medium">Mi rol</span>
                                        <span class="px-5 py-2 bg-indigo-100 text-indigo-700 font-black rounded-full text-sm">
                                            {{ ucfirst(str_replace('_', ' ', $participante->rol)) }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600 font-medium">Estado</span>
                                        <span class="px-5 py-2 rounded-full text-white font-black text-sm
                                                     {{ $equipo->estado === 'aprobado' ? 'bg-emerald-500' : 
                                                        ($equipo->estado === 'pendiente' ? 'bg-amber-500' : 'bg-red-500') }}">
                                            {{ ucfirst($equipo->estado) }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600 font-medium">Miembros</span>
                                        <span class="text-3xl font-black text-indigo-600">
                                            {{ $equipo->participantes->count() }}/{{ $evento->max_miembros }}
                                        </span>
                                    </div>
                                </div>

                                <!-- CTA -->
                                <div class="mt-8 pt-6 border-t-2 border-gray-100 text-center">
                                    <span class="inline-block px-12 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black text-xl rounded-2xl 
                                                 group-hover:shadow-2xl transform group-hover:scale-105 transition-all duration-300">
                                        Ir al dashboard del equipo
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Sin equipos -->
                <div class="text-center py-32 bg-white rounded-3xl shadow-2xl border border-gray-100">
                    <div class="w-48 h-48 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full mx-auto mb-10 flex items-center justify-center">
                        <svg class="w-28 h-28 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-5xl font-black text-gray-900 mb-6">
                        Aún no formas parte de ningún equipo
                    </h3>
                    <p class="text-2xl text-gray-600 mb-12 max-w-2xl mx-auto">
                        ¡El momento es ahora! Únete a un evento activo y forma parte de algo grande
                    </p>
                    <a href="{{ route('eventos.index') }}"
                       class="inline-flex items-center gap-6 px-16 py-8 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-3xl rounded-3xl shadow-2xl hover:shadow-purple-500/50 transform hover:scale-110 transition-all duration-500">
                        Explorar eventos activos
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
=======
<!-- HERO MIS EQUIPOS -->
<section class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white py-24">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Mis Equipos
        </h1>
        <p class="text-xl md:text-2xl font-light max-w-4xl mx-auto opacity-90">
            Aquí puedes ver todos los equipos en los que participas y gestionar tus proyectos
        </p>

        <div class="mt-12 flex flex-wrap justify-center gap-6">
            <div class="bg-white/20 backdrop-blur px-8 py-6 rounded-3xl">
                <p class="text-4xl font-black">{{ auth()->user()->participantes()->count() }}</p>
                <p class="text-lg opacity-90">Equipos activos</p>
            </div>
            <div class="bg-white/20 backdrop-blur px-8 py-6 rounded-3xl">
                <p class="text-4xl font-black">{{ auth()->user()->participantes()->where('es_lider', true)->count() }}</p>
                <p class="text-lg opacity-90">Líder de equipo</p>
            </div>
            <div class="bg-white/20 backdrop-blur px-8 py-6 rounded-3xl">
                <p class="text-4xl font-black">0</p>
                <p class="text-lg opacity-90">Avances publicados</p>
            </div>
        </div>
    </div>
</section>

<!-- LISTA DE MIS EQUIPOS -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-4xl font-black text-gray-900">
                Mis equipos en eventos activos
            </h2>

            <a href="{{ route('eventos.index') }}"
               class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                + Inscribirme en otro evento
            </a>
        </div>

        @if(auth()->user()->participantes()->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach(auth()->user()->participantes()->with('equipo.evento', 'equipo.proyecto')->get() as $participante)
                    @php
                        $equipo = $participante->equipo;
                        $evento = $equipo->evento;
                    @endphp

                    <a href="{{ route('equipos.show', $equipo) }}"
                       class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-4 transition-all duration-500 border border-gray-100">

                        <!-- Banner del evento -->
                        <div class="relative h-48">
                            @if($evento->banner)
                                <img src="{{ Storage::url($evento->banner) }}" alt="{{ $evento->nombre }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-600"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent pointer-events-none"></div>

                            <!-- Nombre del evento -->
                            <div class="absolute bottom-4 left-6 text-white">
                                <p class="text-sm opacity-80">Evento</p>
                                <p class="text-2xl font-black">{{ Str::limit($evento->nombre, 30) }}</p>
                            </div>
                        </div>

                        <!-- Contenido del equipo -->
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    @if($equipo->logo)
                                        <img src="{{ Storage::url($equipo->logo) }}" alt="{{ $equipo->nombre_equipo }}" class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white shadow-xl">
                                    @else
                                        <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center text-white text-3xl font-black shadow-xl">
                                            {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                                        </div>
                                    @endif

                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900 group-hover:text-indigo-600 transition">
                                            {{ $equipo->nombre_equipo }}
                                        </h3>
                                        <p class="text-lg font-bold text-purple-600">
                                            {{ $equipo->nombre_proyecto }}
                                        </p>
                                    </div>
                                </div>

                                @if($participante->es_lider)
                                    <span class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-bold rounded-full text-sm shadow-lg">
                                        Líder
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Mi rol</span>
                                    <span class="px-4 py-2 bg-indigo-100 text-indigo-700 font-bold rounded-full text-sm">
                                        {{ ucfirst(str_replace('_', ' ', $participante->rol)) }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Estado del equipo</span>
                                    <span class="px-4 py-2 rounded-full text-sm font-bold
                                        @if($equipo->estado === 'aprobado') bg-green-100 text-green-700
                                        @elseif($equipo->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ ucfirst($equipo->estado) }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Miembros</span>
                                    <span class="text-2xl font-black text-indigo-600">
                                        {{ $equipo->participantes_count ?? 0 }}/{{ $evento->max_miembros }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Último avance</span>
                                    <span class="font-bold text-indigo-600">
                                        {{ $equipo->proyecto?->avances()?->latest('created_at')->first()?->created_at?->diffForHumans() ?? 'Sin avances' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-6 text-center">
                                <span class="inline-block px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl group-hover:shadow-2xl transform group-hover:scale-105 transition-all duration-300 w-full">
                                    Ir al dashboard del equipo →
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-32 bg-white rounded-3xl shadow-xl">
                <div class="w-40 h-40 bg-gray-200 rounded-full mx-auto mb-8 flex items-center justify-center">
                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-4xl font-black text-gray-900 mb-6">Aún no formas parte de ningún equipo</h3>
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                    ¡Es hora de unirte a la acción! Busca un evento activo y crea o únete a un equipo
                </p>
                <a href="{{ route('eventos.index') }}"
                   class="inline-block px-12 py-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black text-2xl rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500 shadow-2xl">
                    Explorar eventos activos
                </a>
            </div>
        @endif
    </div>
</section>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
@endsection