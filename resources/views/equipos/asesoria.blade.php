{{-- resources/views/equipos/asesoria.blade.php --}}
@extends('layouts.master')

@section('title', 'Asesoría - ' . $equipo->nombre_equipo)

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

        <!-- Asesoría técnica -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-12 border border-white/30">

            @if($equipo->asesoriaAprobada)
                <!-- YA TIENE ASESOR APROBADO -->
                <div class="text-center py-20">
                    <div class="w-48 h-48 mx-auto mb-10 rounded-full overflow-hidden ring-12 ring-emerald-200 shadow-2xl">
                        <img src="{{ $equipo->asesoriaAprobada->asesor->foto_perfil 
                                    ? (filter_var($equipo->asesoriaAprobada->asesor->foto_perfil, FILTER_VALIDATE_URL) 
                                        ? $equipo->asesoriaAprobada->asesor->foto_perfil 
                                        : Storage::url($equipo->asesoriaAprobada->asesor->foto_perfil))
                                    : asset('images/avatar.svg') }}"
                             alt="{{ $equipo->asesoriaAprobada->asesor->name }}"
                             class="w-full h-full object-cover">
                    </div>

                    <h2 class="text-5xl font-black text-emerald-600 mb-6">
                        ¡Tu asesor asignado!
                    </h2>
                    <p class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $equipo->asesoriaAprobada->asesor->name }}
                    </p>
                    <p class="text-xl text-gray-600 mb-8">
                        Especialista en: <span class="font-bold text-emerald-600">
                            {{ ucfirst(str_replace('_', ' ', $equipo->asesoriaAprobada->asesor->especialidad ?? 'Tecnología')) }}
                        </span>
                    </p>

                    <div class="bg-emerald-50 border-2 border-emerald-200 rounded-3xl p-10 max-w-3xl mx-auto">
                        <p class="text-2xl text-emerald-800 font-bold mb-6">
                            "Estoy aquí para ayudarte a llevar tu proyecto al siguiente nivel"
                        </p>
                        <p class="text-gray-700 text-lg">
                            Puedes contactar a tu asesor por correo o en las sesiones de mentoría del evento.
                        </p>
                    </div>
                </div>

            @elseif($equipo->asesoriaPendiente)
                <!-- HAY SOLICITUD PENDIENTE -->
                <div class="text-center py-32">
                    <div class="w-40 h-40 mx-auto mb-12 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <h2 class="text-5xl font-black text-amber-600 mb-6">
                        Solicitud de asesoría en revisión
                    </h2>
                    <p class="text-2xl text-gray-700 mb-8 max-w-2xl mx-auto">
                        Tu solicitud ha sido enviada y está siendo revisada por el equipo organizador.
                        Te notificaremos cuando un asesor sea asignado.
                    </p>

                    <div class="bg-amber-50 border-2 border-amber-200 rounded-3xl p-8 max-w-2xl mx-auto">
                        <p class="text-lg text-amber-800 font-medium">
                            Solicitado el {{ $equipo->asesoriaPendiente->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

            @else
                <!-- NO HAY ASESORÍA SOLICITADA -->
                <div class="text-center py-32">
                    <div class="w-48 h-48 mx-auto mb-12 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>

                    <h2 class="text-5xl font-black text-gray-800 mb-6">
                        ¿Necesitas un mentor técnico?
                    </h2>
                    <p class="text-2xl text-gray-600 mb-12 max-w-3xl mx-auto">
                        Un asesor experto te guiará durante el desarrollo del proyecto, resolverá dudas técnicas
                        y te ayudará a mejorar tu solución.
                    </p>

                    @can('update', $equipo)
                        <form action="{{ route('asesoria.solicitar', $equipo) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center gap-6 px-20 py-12 bg-gradient-to-r from-blue-600 to-indigo-600 
                                           hover:from-blue-700 hover:to-indigo-700 text-white font-black text-4xl 
                                           rounded-3xl shadow-2xl hover:shadow-blue-500/60 
                                           transform hover:scale-110 transition-all duration-500">
                                Solicitar asesor técnico ahora
                                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </form>
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