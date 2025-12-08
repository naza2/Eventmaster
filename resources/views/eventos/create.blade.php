<<<<<<< HEAD
{{-- resources/views/eventos/create.blade.php --}}
@extends('layouts.master')

@section('title', 'Crear nuevo evento')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-4xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-600 mb-4">
                Crear Evento
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Lanza tu hackathon, concurso o feria de proyectos en minutos
            </p>
        </div>

        <!-- Card principal -->
        <div class="bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/40 p-10">

            <!-- Errores -->
            @if($errors->any())
                <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-6 shadow-lg">
                    <p class="font-black text-red-800 mb-3">Errores encontrados:</p>
                    <ul class="space-y-2 text-red-700 font-medium">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
=======
@extends('layouts.master')

@section('title', 'Crear evento')

@section('content')
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-xl p-8">
            <h2 class="text-3xl font-black mb-4">Crear nuevo evento</h2>
            <p class="text-gray-600 mb-6">Completa el formulario para publicar un nuevo evento.</p>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
                        @endforeach
                    </ul>
                </div>
            @endif

<<<<<<< HEAD
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <!-- Banner pequeño + URL -->
                <div class="mb-12">
                    <h3 class="text-xl font-black text-gray-900 mb-6 text-center">Banner del evento</h3>

                    <div x-data="{ preview: '' }" class="max-w-xl mx-auto">
                        <!-- Vista previa -->
                        <div class="flex justify-center mb-6">
                            <div class="w-80 h-44 rounded-2xl overflow-hidden shadow-xl ring-8 ring-purple-100 bg-gradient-to-br from-indigo-200 to-pink-200">
                                <template x-if="preview">
                                    <img :src="preview" alt="Vista previa" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!preview">
                                    <div class="w-full h-full flex items-center justify-center">
                                        <p class="text-white text-5xl font-black opacity-50">EVENTO</p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Opciones en fila -->
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer">
                                <input type="file" name="banner" accept="image/*"
                                       class="hidden"
                                       @change="let file = $event.target.files[0];
                                                if(file){
                                                    let reader = new FileReader();
                                                    reader.onload = (e) => preview = e.target.result;
                                                    reader.readAsDataURL(file);
                                                }">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-2xl text-center transition transform hover:scale-105 shadow-lg">
                                    Subir imagen
                                </div>
                            </label>

                            <div class="relative">
                                <input type="url" name="banner_url"
                                       placeholder="o pega una URL"
                                       class="w-full pl-12 pr-4 py-4 text-sm rounded-2xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition"
                                       @input.debounce.400ms="preview = $event.target.value"
                                       value="{{ old('banner_url') }}">

                                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4 1.414 1.414L9.172 12 5.586 8.414 7 7l4 4 4-4 1.414 1.414-4 4z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.414l-6.414-6.414L7 13.586 12 18.586l5-5L18.414 15l-6.414 6.414z"/>
                                </svg>
                            </div>
                        </div>

                        <p class="text-center mt-4 text-xs text-gray-500">
                            Recomendado: 1600×400px • JPG, PNG, WebP
                        </p>
                    </div>
                </div>

                <!-- Formulario compacto y ordenado -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">Nombre del evento *</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" required
                                   class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">Fecha de inicio *</label>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                   class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">Fecha de fin *</label>
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                                   class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">Descripción</label>
                            <textarea name="descripcion" rows="4"
                                      class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition resize-none"
                                      placeholder="Premios, reglas, temática...">{{ old('descripcion') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">Máximo de miembros por equipo</label>
                            <input type="number" name="max_miembros" value="{{ old('max_miembros') }}" min="1" max="10"
                                   class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="Ej: 4">
                        </div>

                        <div>
                            <label class="block text-lg font-bold text-gray-800 mb-3">Estado del evento *</label>
                            <select name="estado" required
                                    class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                <option value="inscripcion" {{ old('estado', 'inscripcion') === 'inscripcion' ? 'selected' : '' }}>Inscripción abierta</option>
                                <option value="en_curso" {{ old('estado') === 'en_curso' ? 'selected' : '' }}>En curso</option>
                                <option value="finalizado" {{ old('estado') === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="pt-10 border-t-2 border-purple-100 flex flex-col sm:flex-row gap-6">
                    <button type="submit"
                            class="flex-1 px-10 py-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-2xl rounded-3xl shadow-2xl hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-4 group">
                        Crear evento
                        <svg class="w-8 h-8 group-hover:translate-x-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    <a href="{{ route('eventos.index') }}"
                       class="flex-1 px-10 py-6 bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-800 font-black text-2xl rounded-3xl text-center shadow-2xl transform hover:scale-105 transition">
                        Cancelar
                    </a>
=======
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required
                               class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="5" class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                   class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha de fin</label>
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                                   class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Máximo de miembros por equipo</label>
                            <input type="number" name="max_miembros" value="{{ old('max_miembros') }}"
                                   class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" required class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                                <option value="inscripcion" {{ old('estado') == 'inscripcion' ? 'selected' : '' }}>Inscripción abierta</option>
                                <option value="en_curso" {{ old('estado') == 'en_curso' ? 'selected' : '' }}>En curso</option>
                                <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Banner (imagen)</label>
                        <input type="file" name="banner" accept="image/*" class="mt-2 block w-full text-sm text-gray-600">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:shadow-2xl transition">Crear evento</button>
                        <a href="{{ route('eventos.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
                    </div>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
                </div>
            </form>
        </div>
    </div>
<<<<<<< HEAD
</div>
@endsection
=======
</section>
@endsection
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
