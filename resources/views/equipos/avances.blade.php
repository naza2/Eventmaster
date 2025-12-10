{{-- resources/views/equipos/avances.blade.php --}}
@extends('layouts.master')

@section('title', 'Avances - ' . $equipo->nombre_equipo)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-7xl mx-auto px-6">

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

        <!-- Avances -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-12 border border-white/30">

            @if($equipo->proyecto && $equipo->proyecto->avances()->exists())
                <!-- HAY AVANCES -->
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-4xl font-black text-gray-900">Avances del proyecto</h2>

                    @can('update', $equipo)
                        <a href="{{ route('avances.create', $equipo) }}"
                           class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-black text-xl rounded-2xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                            Publicar nuevo avance
                        </a>
                    @endcan
                </div>

                <div class="space-y-12">
                    @foreach($equipo->proyecto->avances()->latest()->get() as $avance)
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-10 border border-gray-200 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <h3 class="text-3xl font-black text-gray-900 mb-2">
                                        {{ $avance->titulo }}
                                    </h3>
                                    <div class="flex items-center gap-4 text-sm text-gray-500">
                                        <span>Por {{ $avance->user->name }}</span>
                                        <span>•</span>
                                        <span>{{ $avance->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <p class="text-7xl font-black text-emerald-600 leading-none">
                                        {{ $avance->porcentaje_avance }}%
                                    </p>
                                    <p class="text-gray-600 font-bold">Avance actual</p>
                                </div>
                            </div>

                            <p class="text-gray-700 text-lg leading-relaxed mb-8">
                                {{ $avance->descripcion }}
                            </p>

                            <!-- Evidencias (imágenes) -->
                            @if($avance->evidencias && count($avance->evidencias) > 0)
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                    @foreach($avance->evidencias as $evidencia)
                                        <div class="group relative rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300">
                                            <img src="{{ Storage::url($evidencia) }}"
                                                 alt="Evidencia del avance"
                                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition"></div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            @else
                <!-- NO HAY AVANCES - BOTÓN GIGANTE -->
                <div class="text-center py-32">
                    <div class="w-48 h-48 mx-auto mb-12 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4m-6 0h6"/>
                        </svg>
                    </div>

                    <h2 class="text-5xl font-black text-gray-800 mb-6">
                        Aún no has publicado avances
                    </h2>
                    <p class="text-2xl text-gray-600 mb-12 max-w-3xl mx-auto">
                        Documenta tu progreso semanalmente. Los jueces valoran mucho el seguimiento del desarrollo
                    </p>

                    @can('update', $equipo)
                        <a href="{{ route('avances.create', $equipo) }}"
                           class="inline-flex items-center gap-6 px-20 py-12 bg-gradient-to-r from-emerald-500 to-teal-600 
                                  hover:from-emerald-600 hover:to-teal-700 text-white font-black text-4xl 
                                  rounded-3xl shadow-2xl hover:shadow-emerald-500/60 
                                  transform hover:scale-110 transition-all duration-500">
                            Publicar primer avance
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