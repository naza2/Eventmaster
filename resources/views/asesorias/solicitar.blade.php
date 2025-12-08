@extends('layouts.app')

@section('title', 'Solicitar asesoría para ' . $equipo->nombre_equipo)

@section('content')
<!-- HERO SOLICITAR ASESORÍA -->
<section class="relative bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Solicitar Asesoría Técnica
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Encuentra al mentor perfecto para <strong class="text-yellow-300">{{ $equipo->nombre_proyecto }}</strong>
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1h12v-1zm0 0h6v-1h-6v-1zm0 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="text-xl font-bold">
                Equipo: {{ $equipo->nombre_equipo }}
            </span>
        </div>
    </div>
</section>

<!-- FORMULARIO DE SOLICITUD -->
<section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-10 text-white">
                <h2 class="text-4xl font-black mb-4">¡Potencia tu proyecto con un mentor!</h2>
                <p class="text-xl opacity-90">
                    Selecciona al profesor o experto que mejor se ajuste a tu tecnología o área
                </p>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('asesoria.solicitar', $equipo) }}" method="POST" class="space-y-12">
                    @csrf

                    <!-- SELECCIÓN DEL ASESOR -->
                    <div>
                        <label for="asesor_id" class="block text-xl font-bold text-gray-800 mb-6">
                            Selecciona tu asesor técnico *
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($asesoresDisponibles as $asesor)
                                <label class="cursor-pointer">
                                    <input type="radio" name="asesor_id" value="{{ $asesor->id }}" required
                                           class="hidden peer" {{ old('asesor_id') == $asesor->id ? 'checked' : '' }}>
                                    
                                    <div class="bg-white rounded-3xl p-8 border-4 border-transparent peer-checked:border-indigo-500 peer-checked:shadow-2xl peer-checked:shadow-indigo-500/20 transition-all duration-300 hover:shadow-xl">
                                        <div class="flex items-center gap-6 mb-6">
                                            <img src="{{ $asesor->foto_perfil ? Storage::url($asesor->foto_perfil) : asset('images/avatar-docente.png') }}"
                                                 alt="{{ $asesor->name }}"
                                                 class="w-24 h-24 rounded-3xl object-cover ring-4 ring-white shadow-xl">
                                            <div>
                                                <h3 class="text-2xl font-black text-gray-900">{{ $asesor->name }}</h3>
                                                <p class="text-indigo-600 font-bold text-lg">{{ $asesor->especialidad ?? 'Experto general' }}</p>
                                            </div>
                                        </div>

                                        <div class="space-y-3">
                                            <div class="flex items-center gap-3 text-gray-700">
                                                <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                                <span class="font-medium">{{ $asesor->carrera?->nombre ?? 'Docente' }}</span>
                                            </div>
                                            <div class="flex items-center gap-3 text-gray-700">
                                                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="font-medium">{{ $asesor->asesorias_aprobadas_count ?? 0 }} equipos asesorados</span>
                                            </div>
                                        </div>

                                        <div class="mt-6 pt-6 border-t border-gray-200">
                                            <p class="text-gray-600 line-clamp-3">
                                                {{ $asesor->bio ?? 'Experto en múltiples tecnologías y metodologías ágiles' }}
                                            </p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('asesor_id
                            <p class="mt-4 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- MENSAJE AL ASESOR -->
                    <div>
                        <label for="mensaje" class="block text-xl font-bold text-gray-800 mb-4">
                            Mensaje para el asesor (opcional pero recomendado)
                        </label>
                        <textarea name="mensaje" id="mensaje" rows="6"
                                  class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                  placeholder="Hola profesor, nos encantaría que nos asesore en nuestro proyecto de {{ $equipo->nombre_proyecto }} porque...">{{ old('mensaje') }}</textarea>
                    </div>

                    <!-- INFO DEL PROYECTO ACTUAL -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-10 border border-gray-200">
                        <h3 class="text-2xl font-black text-gray-900 mb-8">Tu proyecto actual</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <p class="text-sm text-gray-600 font-bold uppercase">Nombre del proyecto</p>
                                <p class="text-2xl font-black text-indigo-600">{{ $equipo->nombre_proyecto }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-bold uppercase">Tecnologías principales</p>
                                <p class="text-xl font-bold text-purple-600">
                                    {{ $equipo->proyecto?->tecnologias ?? 'Sin definir aún' }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-6">
                            <p class="text-sm text-gray-600 font-bold uppercase">Descripción breve</p>
                            <p class="text-lg text-gray-700 leading-relaxed">
                                {{ $equipo->descripcion_proyecto }}
                            </p>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center pt-12">
                        <a href="{{ route('equipos.show', $equipo) }}"
                           class="px-12 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition text-center">
                            ← Volver al equipo
                        </a>
                        <button type="submit"
                                class="px-16 py-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-indigo-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                            Enviar solicitud de asesoría
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection