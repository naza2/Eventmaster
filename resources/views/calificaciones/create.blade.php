@extends('layouts.app')

@section('title', 'Calificar equipo - ' . $equipo->nombre_equipo)

@section('content')
<!-- HERO CALIFICACIÓN -->
<section class="relative bg-gradient-to-br from-red-600 via-orange-700 to-amber-800 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-black mb-8">
                Calificar proyecto
            </h1>
            <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
                Eres juez oficial del evento <strong class="text-yellow-300">{{ $equipo->evento->nombre }}</strong>
            </p>
        </div>

        <!-- TARJETA DEL EQUIPO -->
        <div class="max-w-4xl mx-auto bg-white/10 backdrop-blur-xl rounded-3xl p-10 shadow-2xl border border-white/20">
            <div class="flex items-center gap-8 mb-10">
                @if($equipo->logo)
                    <img src="{{ Storage::url($equipo->logo) }}" alt="{{ $equipo->nombre_equipo }}" class="w-32 h-32 rounded-3xl object-cover ring-8 ring-white/30 shadow-2xl">
                @else
                    <div class="w-32 h-32 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-3xl flex items-center justify-center text-white text-5xl font-black shadow-2xl">
                        {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                    </div>
                @endif

                <div>
                    <h2 class="text-4xl font-black mb-3">
                        {{ $equipo->nombre_equipo }}
                    </h2>
                    <p class="text-3xl font-light opacity-90">
                        "{{ $equipo->nombre_proyecto }}"
                    </p>
                    <div class="flex items-center gap-6 mt-6 text-lg">
                        <span class="flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ $equipo->participantes_count }} miembros
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORMULARIO DE CALIFICACIÓN -->
<section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-orange-700 p-10 text-white">
                <h2 class="text-4xl font-black mb-4">Evalúa con justicia</h2>
                <p class="text-xl opacity-90">
                    Tus calificaciones son confidenciales y solo se usarán para determinar ganadores
                </p>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('calificar.store', $equipo) }}" method="POST" class="space-y-12">
                    @csrf

                    <!-- CRITERIOS DE EVALUACIÓN -->
                    <div>
                        <h3 class="text-3xl font-black text-gray-900 mb-10">
                            Criterios de evaluación
                        </h3>

                        <div class="space-y-10">
                            @foreach($criterios as $criterio)
                                @php
                                    $calificacion = $equipo->calificaciones
                                        ->where('juez_id', auth()->id())
                                        ->where('criterio_id', $criterio->id)
                                        ->first();
                                @endphp

                                <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl p-10 shadow-xl border border-gray-200 hover:shadow-2xl transition">
                                    <div class="flex items-start justify-between mb-8">
                                        <div class="flex-1">
                                            <h4 class="text-2xl font-black text-gray-900 mb-3">
                                                {{ $criterio->nombre }}
                                            </h4>
                                            <p class="text-lg text-gray-600 leading-relaxed">
                                                {{ $criterio->descripcion }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm text-gray-600">Máximo</span>
                                            <p class="text-5xl font-black text-orange-600">
                                                {{ $criterio->puntaje_maximo }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Slider de puntuación -->
                                    <div class="space-y-6">
                                        <div class="flex items-center gap-8">
                                            <input type="range" name="puntaje[{{ $criterio->id }}]" 
                                                   value="{{ old('puntaje.' . $criterio->id, $calificacion?->puntaje ?? 0) }}"
                                                   min="0" max="{{ $criterio->puntaje_maximo }}" step="1"
                                                   class="flex-1 h-6 bg-gray-200 rounded-full appearance-none cursor-pointer accent-orange-600"
                                                   x-data @input="$dispatch('update-score', { id: {{ $criterio->id }}, value: $event.target.value })">
                                            
                                            <span class="text-6xl font-black text-orange-600 w-32 text-center"
                                                  x-data
                                                  x-init="$watch('$dispatch', (e) => { if (e.detail.id == {{ $criterio->id }}) $el.textContent = e.detail.value })">
                                                {{ old('puntaje.' . $criterio->id, $calificacion?->puntaje ?? 0) }}
                                            </span>
                                        </div>

                                        <!-- Marcas del slider -->
                                        <div class="flex justify-between text-sm text-gray-500 px-2">
                                            <span>0</span>
                                            <span>{{ $criterio->puntaje_maximo / 2 }}</span>
                                            <span>{{ $criterio->puntaje_maximo }}</span>
                                        </div>

                                        <!-- Comentario -->
                                        <div>
                                            <label class="block text-lg font-bold text-gray-700 mb-3">
                                                Comentario (opcional)
                                            </label>
                                            <textarea name="comentario[{{ $criterio->id }}]" rows="3"
                                                      class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition shadow-lg"
                                                      placeholder="Fortalezas, áreas de mejora, recomendaciones...">{{ old('comentario.' . $criterio->id, $calificacion?->comentario) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- RESUMEN DE PUNTUACIÓN -->
                    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-3xl p-10 border-2 border-orange-200">
                        <h3 class="text-3xl font-black text-gray-900 mb-8">Resumen de tu calificación</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                            <div>
                                <p class="text-lg text-gray-600 mb-2">Puntaje total posible</p>
                                <p class="text-5xl font-black text-orange-600">
                                    {{ $criterios->sum('puntaje_maximo') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-lg text-gray-600 mb-2">Tu puntaje actual</p>
                                <p class="text-5xl font-black text-green-600" x-data x-init="
                                    document.addEventListener('update-score', (e) => {
                                        let total = 0;
                                        document.querySelectorAll('input[name^=puntaje[').forEach(input => {
                                            total += parseInt(input.value) || 0;
                                        });
                                        $el.textContent = total;
                                    });
                                    // Inicial
                                    let initial = 0;
                                    document.querySelectorAll('input[name^=puntaje[').forEach(i => initial += parseInt(i.value) || 0);
                                    $el.textContent = initial;
                                ">
                                    0
                                </p>
                            </div>
                            <div>
                                <p class="text-lg text-gray-600 mb-2">Promedio</p>
                                <p class="text-5xl font-black text-purple-600" x-data x-init="
                                    document.addEventListener('update-score', () => {
                                        let total = 0;
                                        document.querySelectorAll('input[name^=puntaje[').forEach(i => total += parseInt(i.value) || 0);
                                        let avg = total / {{ $criterios->count() }} || 0;
                                        $el.textContent = avg.toFixed(1);
                                    });
                                    // Inicial
                                    let init = 0;
                                    document.querySelectorAll('input[name^=puntaje[').forEach(i => init += parseInt(i.value) || 0);
                                    $el.textContent = (init / {{ $criterios->count() }} || 0).toFixed(1);
                                ">
                                    0.0
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center pt-12">
                        <a href="{{ route('eventos.show', $equipo->evento) }}"
                           class="px-12 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition text-center">
                            ← Volver al evento
                        </a>
                        <button type="submit"
                                class="px-20 py-6 bg-gradient-to-r from-red-600 to-orange-700 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-orange-500/30 transform hover:scale-105 transition-all duration-500 shadow-2xl">
                            Enviar calificación oficial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection