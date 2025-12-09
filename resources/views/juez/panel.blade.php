@extends('layouts.master')

@section('title', 'Panel de Juez')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 mb-4">
                Panel de Evaluación
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Bienvenido, {{ auth()->user()->name }}
            </p>
            @if(auth()->user()->especialidad)
                <p class="text-lg text-gray-500 mt-2">
                    Especialidad: <span class="font-bold capitalize">{{ str_replace('_', ' ', auth()->user()->especialidad) }}</span>
                </p>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-8 bg-green-50 border-2 border-green-200 rounded-2xl p-6 shadow-lg">
                <p class="font-bold text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-red-50 border-2 border-red-200 rounded-2xl p-6 shadow-lg">
                <p class="font-bold text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Eventos asignados -->
        <div class="bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/40 p-10">
            <h2 class="text-3xl font-black text-gray-900 mb-6">Mis Eventos Asignados</h2>

            @if($eventosAsignados->count() > 0)
                <div class="space-y-6">
                    @foreach($eventosAsignados as $evento)
                        <div class="border-2 border-gray-200 rounded-2xl p-6 hover:border-orange-400 transition-all hover:shadow-xl">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4 mb-4">
                                        <h3 class="text-2xl font-black text-gray-900">{{ $evento->nombre }}</h3>
                                        @if($evento->estado === 'inscripcion')
                                            <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-bold">
                                                Inscripción
                                            </span>
                                        @elseif($evento->estado === 'en_curso')
                                            <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-bold">
                                                En curso
                                            </span>
                                        @elseif($evento->estado === 'finalizado')
                                            <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-bold">
                                                Finalizado
                                            </span>
                                        @endif
                                    </div>

                                    <p class="text-gray-600 mb-4">{{ $evento->descripcion }}</p>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <p class="text-sm text-gray-500">Fecha inicio</p>
                                            <p class="font-bold text-gray-900">{{ $evento->fecha_inicio->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <p class="text-sm text-gray-500">Fecha fin</p>
                                            <p class="font-bold text-gray-900">{{ $evento->fecha_fin->format('d/m/Y') }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <p class="text-sm text-gray-500">Equipos</p>
                                            <p class="font-bold text-gray-900">{{ $evento->equipos->count() }}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-4">
                                            <p class="text-sm text-gray-500">Participantes</p>
                                            <p class="font-bold text-gray-900">{{ $evento->equipos->sum(fn($e) => $e->participantes->count()) }}</p>
                                        </div>
                                    </div>

                                    @if($evento->mi_voto)
                                        <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 mb-4">
                                            <p class="font-bold text-green-800 mb-2">Ya has votado en este evento</p>
                                            <div class="grid grid-cols-3 gap-4 text-sm">
                                                <div>
                                                    <p class="text-green-600 font-semibold">1° Lugar:</p>
                                                    <p class="text-green-900">{{ $evento->mi_voto->primerLugar->nombre_equipo ?? 'N/A' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-green-600 font-semibold">2° Lugar:</p>
                                                    <p class="text-green-900">{{ $evento->mi_voto->segundoLugar->nombre_equipo ?? 'N/A' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-green-600 font-semibold">3° Lugar:</p>
                                                    <p class="text-green-900">{{ $evento->mi_voto->tercerLugar->nombre_equipo ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Botones de acción -->
                            <div class="flex flex-wrap gap-4 mt-6">
                                <a href="{{ route('eventos.show', $evento) }}"
                                   class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                                    Ver Evento
                                </a>

                                @if($evento->estado === 'finalizado')
                                    <a href="{{ route('votos.create', $evento) }}"
                                       class="px-6 py-3 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold rounded-xl transition-all transform hover:scale-105 shadow-lg">
                                        {{ $evento->mi_voto ? 'Modificar Voto' : 'Votar por Puestos' }}
                                    </a>
                                @else
                                    <span class="px-6 py-3 bg-gray-200 text-gray-500 font-bold rounded-xl cursor-not-allowed">
                                        Votación disponible al finalizar
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">No hay eventos asignados</h3>
                    <p class="text-gray-600">Aún no te han asignado a ningún evento como juez.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
