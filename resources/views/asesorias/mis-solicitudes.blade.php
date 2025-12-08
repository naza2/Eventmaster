@extends('layouts.app')

@section('title', 'Mis solicitudes de asesoría')

@section('content')
<!-- HERO MIS SOLICITUDES -->
<section class="relative bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Mis solicitudes de asesoría
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Aquí puedes ver y responder a los equipos que quieren que seas su mentor
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9 9 0 10-9-9z"/>
            </svg>
            <span class="text-xl font-bold">
                {{ $solicitudes->count() }} solicitud{{ $solicitudes->count() !== 1 ? 'es' : '' }} pendiente{{ $solicitudes->count() !== 1 ? 's' : '' }}
            </span>
        </div>
    </div>
</section>

<!-- LISTA DE SOLICITUDES -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        @if($solicitudes->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                @foreach($solicitudes as $solicitud)
                    @php
                        $equipo = $solicitud->equipo;
                        $evento = $equipo->evento;
                    @endphp

                    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transform hover:-translate-y-4 transition-all duration-500 border border-gray-100">
                        <!-- Header de la solicitud -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-3xl font-black">
                                    {{ $equipo->nombre_equipo }}
                                </h3>
                                <span class="px-6 py-3 bg-white/20 backdrop-blur rounded-full font-bold">
                                    {{ $evento->nombre }}
                                </span>
                            </div>
                            <p class="text-2xl font-light opacity-90">
                                "{{ $equipo->nombre_proyecto }}"
                            </p>
                        </div>

                        <!-- Cuerpo -->
                        <div class="p-10">
                            <!-- Información del equipo -->
                            <div class="mb-10">
                                <h4 class="text-xl font-black text-gray-900 mb-6">Equipo solicitante</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-50 rounded-2xl p-6">
                                        <p class="text-sm text-gray-600 font-bold uppercase mb-2">Líder del equipo</p>
                                        <div class="flex items-center gap-4">
                                            <img src="{{ $equipo->lider->user->foto_perfil 
                                                ? Storage::url($equipo->lider->user->foto_perfil) 
                                                : asset('images/avatar.png') }}"
                                                 alt="{{ $equipo->lider->user->name }}"
                                                 class="w-14 h-14 rounded-2xl object-cover ring-4 ring-white shadow-xl">
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $equipo->lider->user->name }}</p>
                                                <p class="text-indigo-600">{{ $equipo->lider->user->carrera?->nombre }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 rounded-2xl p-6">
                                        <p class="text-sm text-gray-600 font-bold uppercase mb-2">Detalles</p>
                                        <p class="font-medium">
                                            <span class="text-gray-600">Miembros:</span>
                                            <span class="font-bold text-indigo-600">{{ $equipo->participantes_count }}/{{ $evento->max_miembros }}</span>
                                        </p>
                                        <p class="text-sm text-gray-600 mt-2">
                                            Solicitado el {{ $solicitud->created_at->format('d/m/Y \a \l\a\s H:i') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Mensaje del equipo -->
                            @if($solicitud->comentarios)
                                <div class="mb-10">
                                    <h4 class="text-xl font-black text-gray-900 mb-4">Mensaje del equipo</h4>
                                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 border border-indigo-100">
                                        <p class="text-gray-800 leading-relaxed text-lg">
                                            "{{ $solicitud->comentarios }}"
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <!-- Acciones -->
                            <div class="flex gap-6">
                                <form action="{{ route('asesoria.aceptar', $solicitud) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="w-full px-10 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-xl rounded-3xl hover:shadow-2xl hover:shadow-green-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                                        Aceptar y ser su asesor
                                    </button>
                                </form>

                                <form action="{{ route('asesoria.rechazar', $solicitud) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('¿Rechazar esta solicitud?')"
                                            class="w-full px-10 py-6 bg-gradient-to-r from-red-500 to-rose-600 text-white font-black text-xl rounded-3xl hover:shadow-2xl hover:shadow-red-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                                        Rechazar solicitud
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-32 bg-white rounded-3xl shadow-2xl">
                <div class="w-40 h-40 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full mx-auto mb-10 flex items-center justify-center">
                    <svg class="w-20 h-20 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9 9 0 10-9-9z"/>
                    </svg>
                </div>
                <h3 class="text-4xl font-black text-gray-900 mb-6">
                    No tienes solicitudes pendientes
                </h3>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Cuando un equipo te solicite como asesor, aparecerá aquí para que puedas aceptar o rechazar
                </p>
            </div>
        @endif
    </div>
</section>
@endsection