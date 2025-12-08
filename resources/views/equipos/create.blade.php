@extends('layouts.master')

@section('title', 'Crear equipo en ' . $evento->nombre)

@section('content')
<!-- HERO CREAR EQUIPO -->
<section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Crear nuevo equipo
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Inscribe tu proyecto en <strong class="text-yellow-300">{{ $evento->nombre }}</strong>
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-xl font-bold">
                Inscripción abierta hasta el {{ $evento->fecha_fin->format('d \d\e F \d\e Y') }}
            </span>
        </div>
    </div>
</section>

<!-- FORMULARIO DE CREACIÓN -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-10 text-white">
                <h2 class="text-4xl font-black mb-4">¡Da vida a tu proyecto!</h2>
                <p class="text-xl opacity-90">
                    Completa la información de tu equipo y comienza tu aventura en {{ $evento->nombre }}
                </p>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('equipo.store', $evento) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf

                    <!-- NOMBRE DEL EQUIPO -->
                    <div>
                        <label for="nombre_equipo" class="block text-xl font-bold text-gray-800 mb-4">
                            Nombre del equipo *
                        </label>
                        <input type="text" name="nombre_equipo" id="nombre_equipo" required
                               value="{{ old('nombre_equipo') }}"
                               class="w-full px-8 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg @error('nombre_equipo') border-red-500 @enderror"
                               placeholder="Ej: Los Crackers del Código">
                        @error('nombre_equipo')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NOMBRE DEL PROYECTO -->
                    <div>
                        <label for="nombre_proyecto" class="block text-xl font-bold text-gray-800 mb-4">
                            Nombre del proyecto *
                        </label>
                        <input type="text" name="nombre_proyecto" id="nombre_proyecto" required
                               value="{{ old('nombre_proyecto') }}"
                               class="w-full px-8 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg @error('nombre_proyecto') border-red-500 @enderror"
                               placeholder="Ej: App para reciclaje inteligente">
                        @error('nombre_proyecto')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DESCRIPCIÓN DEL PROYECTO -->
                    <div>
                        <label for="descripcion_proyecto" class="block text-xl font-bold text-gray-800 mb-4">
                            ¿Qué problema resuelve tu proyecto? *
                        </label>
                        <textarea name="descripcion_proyecto" id="descripcion_proyecto" rows="6" required
                                  class="w-full px-8 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg @error('descripcion_proyecto') border-red-500 @enderror"
                                  placeholder="Explica en unas líneas qué hace tu proyecto y por qué es importante...">{{ old('descripcion_proyecto') }}</textarea>
                        @error('descripcion_proyecto')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- LOGO DEL EQUIPO -->
                    <div>
                        <label for="logo" class="block text-xl font-bold text-gray-800 mb-4">
                            Logo del equipo (opcional)
                        </label>
                        <div class="border-4 border-dashed border-gray-300 rounded-3xl p-12 text-center hover:border-indigo-400 transition">
                            <input type="file" name="logo" id="logo" accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(event)">
                            <label for="logo" class="cursor-pointer">
                                <svg class="w-20 h-20 mx-auto text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                </svg>
                                <p class="text-xl font-bold text-gray-700">Haz clic para subir logo</p>
                                <p class="text-gray-500 mt-2">PNG, JPG hasta 2MB</p>
                            </label>
                            <div id="preview" class="mt-6 hidden">
                                <img id="preview-img" class="mx-auto max-h-48 rounded-2xl shadow-xl" src="" alt="Vista previa">
                            </div>
                        </div>
                        @error('logo')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- INFORMACIÓN DEL LÍDER (automática) -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl p-8 border border-indigo-100">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Tú eres el líder del equipo</h3>
                        <div class="flex items-center gap-6">
                            <img src="{{ auth()->user()->foto_perfil ? Storage::url(auth()->user()->foto_perfil) : asset('images/avatar.svg') }}"
                                 alt="{{ auth()->user()->name }}"
                                 class="w-24 h-24 rounded-2xl object-cover ring-4 ring-white shadow-xl">
                            <div>
                                <p class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-lg text-indigo-600 font-semibold">{{ auth()->user()->carrera?->nombre ?? 'Sin carrera' }}</p>
                                <p class="text-gray-600">{{ auth()->user()->matricula }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center pt-10">
                        <a href="{{ route('eventos.show', $evento) }}"
                           class="px-12 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition text-center">
                            ← Cancelar
                        </a>
                        <button type="submit"
                                class="px-16 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-green-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                            Crear equipo y continuar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT PARA PREVISUALIZAR IMAGEN -->
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const img = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection