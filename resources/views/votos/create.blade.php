@extends('layouts.master')

@section('title', 'Votar por Puestos - ' . $evento->nombre)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-pink-50 py-12">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-orange-600 via-red-600 to-pink-600 mb-4">
                Votación por Puestos
            </h1>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $evento->nombre }}</h2>
            <p class="text-lg text-gray-600">
                Selecciona los equipos ganadores del 1°, 2° y 3° lugar
            </p>
        </div>

        @if(session('error'))
            <div class="mb-8 bg-red-50 border-2 border-red-200 rounded-2xl p-6 shadow-lg">
                <p class="font-bold text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-8 bg-red-50 border-2 border-red-200 rounded-2xl p-6 shadow-lg">
                <p class="font-bold text-red-800 mb-3">Errores encontrados:</p>
                <ul class="space-y-2 text-red-700">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($votoExistente)
            <div class="mb-8 bg-blue-50 border-2 border-blue-200 rounded-2xl p-6 shadow-lg">
                <p class="font-bold text-blue-800 mb-2">Ya has votado en este evento</p>
                <p class="text-blue-700">Puedes modificar tu voto usando el formulario a continuación.</p>
            </div>
        @endif

        <!-- Formulario de votación -->
        <form action="{{ route('votos.store', $evento) }}" method="POST" x-data="{
            primer_lugar: {{ $votoExistente->primer_lugar_id ?? 'null' }},
            segundo_lugar: {{ $votoExistente->segundo_lugar_id ?? 'null' }},
            tercer_lugar: {{ $votoExistente->tercer_lugar_id ?? 'null' }},
            getSeleccionados() {
                return [this.primer_lugar, this.segundo_lugar, this.tercer_lugar].filter(id => id !== null);
            },
            isSeleccionado(equipoId) {
                return this.getSeleccionados().includes(equipoId);
            },
            canSelect(equipoId, puesto) {
                if (this[puesto] === equipoId) return true;
                return !this.isSeleccionado(equipoId);
            }
        }">
            @csrf

            <div class="bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/40 p-10 space-y-10">

                @if($equipos->count() >= 3)
                    <!-- Primer Lugar -->
                    <div>
                        <label class="block text-2xl font-black text-gray-900 mb-4">
                            <span class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-full mr-3">1°</span>
                            Primer Lugar
                        </label>
                        <select name="primer_lugar_id" required
                                x-model.number="primer_lugar"
                                class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 shadow-lg transition">
                            <option value="">-- Selecciona el equipo ganador --</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}"
                                        :disabled="!canSelect({{ $equipo->id }}, 'primer_lugar')"
                                        {{ old('primer_lugar_id', $votoExistente->primer_lugar_id ?? '') == $equipo->id ? 'selected' : '' }}>
                                    {{ $equipo->nombre_equipo }} - {{ $equipo->nombre_proyecto }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Segundo Lugar -->
                    <div>
                        <label class="block text-2xl font-black text-gray-900 mb-4">
                            <span class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-gray-300 to-gray-400 text-white rounded-full mr-3">2°</span>
                            Segundo Lugar
                        </label>
                        <select name="segundo_lugar_id" required
                                x-model.number="segundo_lugar"
                                class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 shadow-lg transition">
                            <option value="">-- Selecciona el segundo lugar --</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}"
                                        :disabled="!canSelect({{ $equipo->id }}, 'segundo_lugar')"
                                        {{ old('segundo_lugar_id', $votoExistente->segundo_lugar_id ?? '') == $equipo->id ? 'selected' : '' }}>
                                    {{ $equipo->nombre_equipo }} - {{ $equipo->nombre_proyecto }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tercer Lugar -->
                    <div>
                        <label class="block text-2xl font-black text-gray-900 mb-4">
                            <span class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-orange-400 to-orange-500 text-white rounded-full mr-3">3°</span>
                            Tercer Lugar
                        </label>
                        <select name="tercer_lugar_id" required
                                x-model.number="tercer_lugar"
                                class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 shadow-lg transition">
                            <option value="">-- Selecciona el tercer lugar --</option>
                            @foreach($equipos as $equipo)
                                <option value="{{ $equipo->id }}"
                                        :disabled="!canSelect({{ $equipo->id }}, 'tercer_lugar')"
                                        {{ old('tercer_lugar_id', $votoExistente->tercer_lugar_id ?? '') == $equipo->id ? 'selected' : '' }}>
                                    {{ $equipo->nombre_equipo }} - {{ $equipo->nombre_proyecto }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Comentario opcional -->
                    <div>
                        <label class="block text-xl font-bold text-gray-900 mb-4">Comentario (opcional)</label>
                        <textarea name="comentario" rows="4"
                                  class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 shadow-lg transition resize-none"
                                  placeholder="Agrega tus observaciones sobre la votación...">{{ old('comentario', $votoExistente->comentario ?? '') }}</textarea>
                    </div>

                    <!-- Botones -->
                    <div class="pt-10 border-t-2 border-orange-100 flex flex-col sm:flex-row gap-6">
                        <button type="submit"
                                class="flex-1 px-10 py-6 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-black text-2xl rounded-3xl shadow-2xl hover:shadow-orange-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-4 group">
                            {{ $votoExistente ? 'Actualizar Voto' : 'Enviar Voto' }}
                            <svg class="w-8 h-8 group-hover:translate-x-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>

                        <a href="{{ route('juez.panel') }}"
                           class="flex-1 px-10 py-6 bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-800 font-black text-2xl rounded-3xl text-center shadow-2xl transform hover:scale-105 transition">
                            Cancelar
                        </a>
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-2xl font-black text-gray-900 mb-2">No hay suficientes equipos</h3>
                        <p class="text-gray-600">Se necesitan al menos 3 equipos para realizar la votación.</p>
                        <a href="{{ route('juez.panel') }}"
                           class="mt-6 inline-block px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold rounded-xl hover:from-gray-600 hover:to-gray-700 transition">
                            Volver al Panel
                        </a>
                    </div>
                @endif
            </div>
        </form>

        <!-- Vista previa de equipos -->
        @if($equipos->count() >= 3)
            <div class="mt-12 bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/40 p-10">
                <h3 class="text-3xl font-black text-gray-900 mb-6">Equipos Participantes</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($equipos as $equipo)
                        <div class="border-2 border-gray-200 rounded-2xl p-6 hover:border-orange-400 transition-all hover:shadow-lg">
                            <h4 class="text-xl font-black text-gray-900 mb-2">{{ $equipo->nombre_equipo }}</h4>
                            <p class="text-gray-600 mb-4">{{ $equipo->nombre_proyecto }}</p>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <span>{{ $equipo->participantes->count() }} miembros</span>
                            </div>
                            <a href="{{ route('equipos.show', $equipo) }}"
                               class="mt-4 block text-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-lg hover:from-blue-600 hover:to-blue-700 transition">
                                Ver Detalles
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
