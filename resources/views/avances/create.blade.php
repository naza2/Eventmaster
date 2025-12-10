{{-- resources/views/avances/create.blade.php --}}
@extends('layouts.master')

@section('title', 'Publicar avance - ' . $equipo->nombre_equipo)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-4xl mx-auto px-6">

        <div class="text-center mb-12">
            <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 mb-4">
                Publicar nuevo avance
            </h1>
            <p class="text-xl text-gray-600">Documenta tu progreso y mantén al día a los jueces</p>
        </div>

        <div class="bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/40 p-10">
            <form action="{{ route('avances.store', $equipo) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <div>
                    <label class="block text-xl font-black text-gray-900 mb-4">Título del avance *</label>
                    <input type="text" name="titulo" required value="{{ old('titulo') }}"
                           class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 shadow-lg transition"
                           placeholder="Ej: Prototipo funcional completado">
                </div>

                <div>
                    <label class="block text-xl font-black text-gray-900 mb-4">Descripción *</label>
                    <textarea name="descripcion" rows="6" required
                              class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 shadow-lg transition resize-none"
                              placeholder="Explica qué hiciste esta semana, obstáculos, soluciones...">{{ old('descripcion') }}</textarea>
                </div>

                <div>
                    <label class="block text-xl font-black text-gray-900 mb-4">
                        Porcentaje de avance actual (%) *
                    </label>
                    <input type="number" name="porcentaje_avance" required min="0" max="100" value="{{ old('porcentaje_avance') }}"
                           class="w-full px-6 py-5 text-3xl font-black text-center border-2 border-gray-200 rounded-2xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 shadow-lg transition">
                </div>

                <div>
                    <label class="block text-xl font-black text-gray-900 mb-4">
                        Evidencias (fotos, capturas) - opcional
                    </label>
                    <input type="file" name="evidencias[]" multiple accept="image/*"
                           class="w-full px-6 py-5 text-lg border-2 border-dashed border-gray-300 rounded-2xl file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:bg-emerald-500 file:text-white hover:file:bg-emerald-600 cursor-pointer">
                    <p class="text-sm text-gray-500 mt-3">Máximo 5MB por imagen • JPG, PNG, WebP</p>
                </div>

                <div class="pt-10 border-t-2 border-emerald-100 flex gap-6">
                    <button type="submit"
                            class="flex-1 px-10 py-6 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-black text-2xl rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-4">
                        Publicar avance
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>

                    <a href="{{ route('equipos.avances', $equipo) }}"
                       class="flex-1 px-10 py-6 bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-800 font-black text-2xl rounded-3xl text-center shadow-2xl transform hover:scale-105 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection