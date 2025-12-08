@extends('layouts.app')

@section('title', 'Publicar avance - ' . $proyecto->equipo->nombre_proyecto)

@section('content')
<!-- HERO PUBLICAR AVANCE -->
<section class="relative bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Publicar avance
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Comparte el progreso de <strong class="text-yellow-300">{{ $proyecto->equipo->nombre_proyecto }}</strong>
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <span class="text-xl font-bold">
                Equipo: {{ $proyecto->equipo->nombre_equipo }}
            </span>
        </div>
    </div>
</section>

<!-- FORMULARIO DE AVANCE -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-10 text-white">
                <h2 class="text-4xl font-black mb-4">¡Muestra tu progreso al mundo!</h2>
                <p class="text-xl opacity-90">
                    Cada avance cuenta. Comparte lo que has logrado esta semana
                </p>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('avances.store', $proyecto) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf

                    <!-- TÍTULO DEL AVANCE -->
                    <div>
                        <label for="titulo" class="block text-xl font-bold text-gray-800 mb-4">
                            Título del avance *
                        </label>
                        <input type="text" name="titulo" id="titulo" required
                               value="{{ old('titulo') }}"
                               class="w-full px-8 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition shadow-lg @error('titulo') border-red-500 @enderror"
                               placeholder="Ej: Completamos el login con Laravel + Filament">
                        @error('titulo')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div>
                        <label for="descripcion" class="block text-xl font-bold text-gray-800 mb-4">
                            ¿Qué lograste esta semana? *
                        </label>
                        <textarea name="descripcion" id="descripcion" rows="8" required
                                  class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-green-500 focus:ring-4 focus:ring-green-100 transition shadow-lg @error('descripcion') border-red-500 @enderror"
                                  placeholder="Describe lo que hiciste, problemas que resolviste, nuevas funcionalidades...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PORCENTAJE DE AVANCE -->
                    <div>
                        <label for="porcentaje_avance" class="block text-xl font-bold text-gray-800 mb-4">
                            ¿Cuánto has avanzado? *
                        </label>
                        <div class="flex items-center gap-6">
                            <input type="range" name="porcentaje_avance" id="porcentaje_avance" min="0" max="100"
                                   value="{{ old('porcentaje_avance', $proyecto->avances->sum('porcentaje_avance') ?? 0) }}"
                                   class="flex-1 h-4 bg-gray-200 rounded-full appearance-none cursor-pointer">
                            <span class="text-5xl font-black text-green-600 w-32 text-right" id="porcentaje-value">
                                {{ old('porcentaje_avance', $proyecto->avances->sum('porcentaje_avance') ?? 0) }}%
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-3">
                            Avance actual del proyecto: <strong>{{ $proyecto->avances->sum('porcentaje_avance') ?? 0 }}%</strong>
                        </p>
                    </div>

                    <!-- SUBIR EVIDENCIAS (FOTOS/VIDEOS) -->
                    <div>
                        <label class="block text-xl font-bold text-gray-800 mb-6">
                            Evidencias (fotos, capturas, videos) - máximo 5 archivos
                        </label>
                        <div class="border-4 border-dashed border-gray-300 rounded-3xl p-12 text-center hover:border-green-400 transition">
                            <input type="file" name="evidencias[]" id="evidencias" multiple accept="image/*,video/*" 
                                   class="hidden" onchange="previewFiles(event)">
                            <label for="evidencias" class="cursor-pointer">
                                <svg class="w-20 h-20 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-xl font-bold text-gray-700">Haz clic o arrastra archivos aquí</p>
                                <p class="text-gray-500 mt-2">JPG, PNG, MP4 • Máx 10MB cada uno</p>
                            </label>
                            <div id="preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8"></div>
                        </div>
                        @error('evidencias')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                        @error('evidencias.*')
                            <p class="mt-3 text-red-600 font-medium">Uno o más archivos no son válidos</p>
                        @enderror
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center pt-10">
                        <a href="{{ route('equipos.show', $proyecto->equipo) }}"
                           class="px-12 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition text-center">
                            ← Cancelar
                        </a>
                        <button type="submit"
                                class="px-16 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-green-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                            Publicar avance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT PARA PREVISUALIZAR ARCHIVOS -->
<script>
function previewFiles(event) {
    const files = event.target.files;
    const container = document.getElementById('preview-container');
    container.innerHTML = '';

    if (files.length === 0) return;

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group';

            if (file.type.startsWith('image/')) {
                div.innerHTML = `
                    <img src="${e.target.result}" class="rounded-xl object-cover w-full h-40 shadow-lg group-hover:shadow-2xl transition">
                    <div class="absolute inset-0 bg-black/50 rounded-xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center pointer-events-none">
                        <p class="text-white font-bold relative z-10 pointer-events-auto">${file.name}</p>
                    </div>
                `;
            } else if (file.type.startsWith('video/')) {
                div.innerHTML = `
                    <video src="${e.target.result}" class="rounded-xl w-full h-40 object-cover shadow-lg" controls></video>
                    <p class="text-center mt-2 text-sm text-gray-700">${file.name}</p>
                `;
            }
            container.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

// Actualizar porcentaje en tiempo real
document.getElementById('porcentaje_avance')?.addEventListener('input', function() {
    document.getElementById('porcentaje-value').textContent = this.value + '%';
});
</script>
@endsection