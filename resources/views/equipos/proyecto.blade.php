{{-- resources/views/equipos/proyecto.blade.php --}}
@extends('layouts.master')

@section('title', 'Proyecto - ' . $equipo->nombre_equipo)

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

        <!-- Contenido del proyecto -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-12 border border-white/30">

            @if($equipo->proyecto)
                <!-- PROYECTO YA EXISTE -->
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-4xl font-black text-gray-900">Detalles del Proyecto</h2>

                    @can('update', $equipo)
                        <a href="{{ route('proyecto.edit', $equipo) }}"
                           class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-black text-xl rounded-2xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                            Editar proyecto
                        </a>
                    @endcan
                </div>

                <div class="grid md:grid-cols-2 gap-12 mb-12">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800 mb-6 flex items-center gap-3">
                            Problema que resuelve
                        </h3>
                        <div class="bg-red-50 border border-red-200 rounded-2xl p-8">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                {{ $equipo->proyecto->problema_resuelto }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-2xl font-black text-gray-800 mb-6 flex items-center gap-3">
                            Solución propuesta
                        </h3>
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-8">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                {{ $equipo->proyecto->solucion_propuesta }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Enlaces del proyecto -->
                @if($equipo->proyecto->repositorio && ($equipo->proyecto->repositorio->github || $equipo->proyecto->repositorio->demo || $equipo->proyecto->repositorio->video_pitch))
                    <div class="pt-12 border-t-2 border-gray-100">
                        <h3 class="text-3xl font-black text-gray-900 mb-10 text-center">Enlaces del proyecto</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            @if($equipo->proyecto->repositorio->github)
                                <a href="{{ $equipo->proyecto->repositorio->github }}" target="_blank"
                                   class="group flex flex-col items-center justify-center py-12 bg-black text-white rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                                    <svg class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                    <span class="font-black text-2xl">GitHub</span>
                                </a>
                            @endif

                            @if($equipo->proyecto->repositorio->demo)
                                <a href="{{ $equipo->proyecto->repositorio->demo }}" target="_blank"
                                   class="group flex flex-col items-center justify-center py-12 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    <span class="font-black text-2xl">Demo en vivo</span>
                                </a>
                            @endif

                            @if($equipo->proyecto->repositorio->video_pitch)
                                <a href="{{ $equipo->proyecto->repositorio->video_pitch }}" target="_blank"
                                   class="group flex flex-col items-center justify-center py-12 bg-red-600 text-white rounded-3xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                                    <svg class="w-16 h-16 mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.752 11.168l-6.718-3.867A1 1 0 007 8.108v7.784a1 1 0 001.034.999l6.718-3.867a1 1 0 000-1.856z"/>
                                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"/>
                                    </svg>
                                    <span class="font-black text-2xl">Video Pitch</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

            @else
                <!-- NO HAY PROYECTO AÚN - BOTÓN GRANDE DE CREAR -->
                <div class="text-center py-32">
                    <div class="w-40 h-40 mx-auto mb-10 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>

                    <h2 class="text-5xl font-black text-gray-800 mb-6">
                        Tu proyecto aún no está definido
                    </h2>
                    <p class="text-2xl text-gray-600 mb-12 max-w-2xl mx-auto">
                        Los jueces necesitan conocer tu problema, solución y enlaces para evaluarte correctamente
                    </p>

                    @can('update', $equipo)
                        <a href="{{ route('proyecto.create', $equipo) }}"
                           class="inline-flex items-center gap-6 px-16 py-10 bg-gradient-to-r from-emerald-500 to-teal-600 
                                  hover:from-emerald-600 hover:to-teal-700 text-white font-black text-3xl 
                                  rounded-3xl shadow-2xl hover:shadow-emerald-500/50 
                                  transform hover:scale-110 transition-all duration-500">
                            Completar información del proyecto
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @endcan
                </div>
            @endif
        </div>

        <!-- Volver al dashboard -->
        <div class="mt-12 text-center">
            <a href="{{ route('equipos.show', $equipo) }}"
               class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-xl rounded-2xl hover:shadow-2xl transition">
                Volver al dashboard del equipo
            </a>
        </div>
    </div>
</div>
@endsection