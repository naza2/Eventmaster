{{-- resources/views/equipos/repositorio.blade.php --}}
@extends('layouts.master')

@section('title', 'Repositorio - ' . $equipo->nombre_equipo)

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
                    <p class="text-2xl text-indigo-600 font-bold">{{ $equipo->nombre_proyecto }}</p>
                </div>
            </div>
        </div>

        <!-- Repositorio -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-12 border border-white/30">

            @if($equipo->proyecto?->repositorio && ($equipo->proyecto->repositorio->github || $equipo->proyecto->repositorio->demo || $equipo->proyecto->repositorio->video_pitch))
                <!-- HAY ENLACES -->
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-4xl font-black text-gray-900">Repositorio y enlaces del proyecto</h2>

                    @can('update', $equipo)
                        <a href="{{ route('proyecto.edit', $equipo) }}"
                           class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black text-xl rounded-2xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                            Editar enlaces
                        </a>
                    @endcan
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @if($equipo->proyecto->repositorio->github)
                        <a href="{{ $equipo->proyecto->repositorio->github }}" target="_blank"
                           class="group flex flex-col items-center justify-center py-16 bg-black text-white rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                            <svg class="w-24 h-24 mb-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            <span class="font-black text-3xl">GitHub</span>
                            <span class="text-sm mt-3 opacity-80">Ver código fuente</span>
                        </a>
                    @endif

                    @if($equipo->proyecto->repositorio->demo)
                        <a href="{{ $equipo->proyecto->repositorio->demo }}" target="_blank"
                           class="group flex flex-col items-center justify-center py-16 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                            <svg class="w-24 h-24 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            <span class="font-black text-3xl">Demo en vivo</span>
                            <span class="text-sm mt-3 opacity-80">Probar el proyecto</span>
                        </a>
                    @endif

                    @if($equipo->proyecto->repositorio->video_pitch)
                        <a href="{{ $equipo->proyecto->repositorio->video_pitch }}" target="_blank"
                           class="group flex flex-col items-center justify-center py-16 bg-red-600 text-white rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                            <svg class="w-24 h-24 mb-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.752 11.168l-6.718-3.867A1 1 0 007 8.108v7.784a1 1 0 001.034.999l6.718-3.867a1 1 0 000-1.856z"/>
                                <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"/>
                            </svg>
                            <span class="font-black text-3xl">Video Pitch</span>
                            <span class="text-sm mt-3 opacity-80">Presentación oficial</span>
                        </a>
                    @endif
                </div>

            @else
                <!-- NO HAY ENLACES -->
                <div class="text-center py-32">
                    <div class="w-48 h-48 mx-auto mb-12 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>

                    <h2 class="text-5xl font-black text-gray-800 mb-6">
                        Aún no hay enlaces al repositorio
                    </h2>
                    <p class="text-2xl text-gray-600 mb-12 max-w-2xl mx-auto">
                        Los jueces necesitan acceso al código y demo para evaluar tu proyecto
                    </p>

                    @can('update', $equipo)
                        <a href="{{ route('proyecto.edit', $equipo) }}"
                           class="inline-flex items-center gap-6 px-20 py-12 bg-gradient-to-r from-indigo-600 to-purple-600 
                                  hover:from-indigo-700 hover:to-purple-700 text-white font-black text-4xl 
                                  rounded-3xl shadow-2xl hover:shadow-purple-500/60 
                                  transform hover:scale-110 transition-all duration-500">
                            Añadir enlaces ahora
                            <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @endcan
                </div>
            @endif
        </div>

        <!-- Volver -->
        <div class="mt-12 text-center">
            <a href="{{ route('equipos.show', $equipo) }}"
               class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-xl rounded-2xl hover:shadow-2xl transition">
                Volver al dashboard
            </a>
        </div>
    </div>
</div>
@endsection