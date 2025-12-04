@extends('layouts.master')

@section('title', 'Mis Equipos')

@section('content')
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
@endsection