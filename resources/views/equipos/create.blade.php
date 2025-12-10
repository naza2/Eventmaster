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

                    <!-- LOGO DEL EQUIPO - Compacto, bonito y con URL + archivo -->
                    <div class="mb-12">
                        <h3 class="text-xl font-black text-gray-900 mb-6 text-center">
                            Logo del equipo <span class="text-gray-500 font-normal">(opcional)</span>
                        </h3>

                        <div x-data="{ preview: '' }" class="max-w-md mx-auto">

                            <!-- Vista previa pequeña -->
                            <div class="flex justify-center mb-6">
                                <div class="relative">
                                    <div class="w-32 h-32 rounded-3xl overflow-hidden shadow-2xl ring-8 ring-purple-100 bg-gradient-to-br from-purple-200 to-pink-200">
                                        <template x-if="preview">
                                            <img :src="preview" alt="Logo del equipo" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!preview">
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </div>
                                        </template>
                                    </div>

                                    <!-- Check si hay logo -->
                                    <div x-show="preview" class="absolute -bottom-2 -right-2">
                                        <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center shadow-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Opciones en fila -->
                            <div class="grid grid-cols-2 gap-4">

                                <!-- Subir archivo -->
                                <label class="cursor-pointer">
                                    <input type="file"
                                        name="logo"
                                        accept="image/*"
                                        class="hidden"
                                        @change="let file = $event.target.files[0];
                                                    if(file){
                                                        let reader = new FileReader();
                                                        reader.onload = (e) => preview = e.target.result;
                                                        reader.readAsDataURL(file);
                                                    }">
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 
                                                text-white font-bold py-4 px-6 rounded-2xl text-center 
                                                transition transform hover:scale-105 shadow-lg">
                                        Subir logo
                                    </div>
                                </label>

                                <!-- Pegar URL -->
                                <div class="relative">
                                    <input type="url"
                                        name="logo_url"
                                        placeholder="o pega una URL"
                                        class="w-full pl-12 pr-4 py-4 text-sm rounded-2xl border-2 border-gray-200 
                                                focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition"
                                        @input.debounce.400ms="preview = $event.target.value"
                                        value="{{ old('logo_url') }}">

                                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" 
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4 1.414 1.414L9.172 12 5.586 8.414 7 7l4 4 4-4 1.414 1.414-4 4z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M12 21.414l-6.414-6.414L7 13.586 12 18.586l5-5L18.414 15l-6.414 6.414z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Nota pequeña -->
                            <p class="text-center mt-4 text-xs text-gray-500">
                                PNG, JPG, WebP • Máx 2MB • Recomendado cuadrado
                            </p>

                            <!-- Errores -->
                            @error('logo')
                                <p class="text-center mt-3 text-red-600 font-medium text-sm">{{ $message }}</p>
                            @enderror
                            @error('logo_url')
                                <p class="text-center mt-3 text-red-600 font-medium text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- INFORMACIÓN DEL LÍDER (automática) - Soporta URL y local -->
<div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-3xl p-8 border border-indigo-100">
    <h3 class="text-2xl font-black text-gray-900 mb-6">Tú eres el líder del equipo</h3>
    <div class="flex items-center gap-6">
        
        <!-- FOTO: Local o URL -->
        <div class="relative flex-shrink-0">
            @if(auth()->user()->foto_perfil)
                <img src="{{ 
                    filter_var(auth()->user()->foto_perfil, FILTER_VALIDATE_URL) 
                        ? auth()->user()->foto_perfil 
                        : Storage::url(auth()->user()->foto_perfil)
                }}"
                     alt="{{ auth()->user()->name }}"
                     class="w-24 h-24 rounded-2xl object-cover ring-4 ring-white shadow-xl">
            @else
                <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-600 
                            flex items-center justify-center text-white font-black text-3xl shadow-xl ring-4 ring-white">
                    {{ Str::upper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif

            <!-- Check de líder -->
            <div class="absolute -bottom-2 -right-2">
                <div class="w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full 
                            flex items-center justify-center shadow-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Información del líder -->
        <div>
            <p class="text-2xl font-black text-gray-900">{{ auth()->user()->name }}</p>
            <p class="text-lg text-indigo-600 font-semibold">
                {{ auth()->user()->carrera?->nombre ?? 'Sin carrera' }}
            </p>
            <p class="text-gray-600 font-medium">{{ auth()->user()->matricula ?? 'Sin matrícula' }}</p>
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