{{-- resources/views/proyectos/create.blade.php --}}
@extends('layouts.master')

@section('title', 'Completar información del proyecto')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-5xl mx-auto px-6">

        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-4">
                Completa tu proyecto
            </h1>
            <p class="text-xl text-gray-600 font-medium">
                Esta información será visible para los jueces y participantes
            </p>
        </div>

        <!-- Card principal -->
        <div class="bg-white/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/40 p-10">

            @if($errors->any())
                <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-6">
                    <p class="font-black text-red-800 mb-3">Errores encontrados:</p>
                    <ul class="space-y-2 text-red-700 font-medium">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('proyecto.store', $equipo) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf

                <!-- Problema y solución -->
                <div class="grid md:grid-cols-2 gap-10">
                    <div>
                        <label class="block text-xl font-black text-gray-900 mb-4">
                            Problema que resuelve *
                        </label>
                        <textarea name="problema_resuelto" rows="6" required
                                  class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl 
                                         focus:border-red-500 focus:ring-4 focus:ring-red-100 
                                         shadow-lg transition resize-none"
                                  placeholder="¿Qué necesidad o dolor estás solucionando?">{{ old('problema_resuelto') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xl font-black text-gray-900 mb-4">
                            Solución propuesta *
                        </label>
                        <textarea name="solucion_propuesta" rows="6" required
                                  class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl 
                                         focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 
                                         shadow-lg transition resize-none"
                                  placeholder="¿Cómo lo estás resolviendo?">{{ old('solucion_propuesta') }}</textarea>
                    </div>
                </div>

                <!-- Tecnologías -->
                <div>
                    <label class="block text-xl font-black text-gray-900 mb-4">
                        Tecnologías utilizadas (separadas por comas)
                    </label>
                    <input type="text" name="tecnologias"
                           value="{{ old('tecnologias') }}"
                           class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl 
                                  focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                           placeholder="Laravel, React, Node.js, MySQL, Tailwind...">
                </div>

                <!-- Enlaces del proyecto -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xl font-black text-gray-900 mb-4">
                            Repositorio GitHub
                        </label>
                        <input type="url" name="github"
                               value="{{ old('github') }}"
                               class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl 
                                      focus:border-black focus:ring-4 focus:ring-gray-100 shadow-lg transition"
                               placeholder="https://github.com/tu-usuario/tu-proyecto">
                    </div>

                    <div>
                        <label class="block text-xl font-black text-gray-900 mb-4">
                            Demo en vivo (opcional)
                        </label>
                        <input type="url" name="demo"
                               value="{{ old('demo') }}"
                               class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl 
                                      focus:border-blue-500 focus:ring-4 focus:ring-blue-100 shadow-lg transition"
                               placeholder="https://tu-proyecto.com">
                    </div>
                </div>

                <!-- Video Pitch -->
                <div>
                    <label class="block text-xl font-black text-gray-900 mb-4">
                        Video Pitch (YouTube, Vimeo, etc.)
                    </label>
                    <input type="url" name="video_pitch"
                           value="{{ old('video_pitch') }}"
                           class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl 
                                  focus:border-red-500 focus:ring-4 focus:ring-red-100 shadow-lg transition"
                           placeholder="https://youtube.com/watch?v=...">
                </div>

                <!-- Botones -->
                <div class="pt-10 border-t-2 border-purple-100 flex flex-col sm:flex-row gap-6">
                    <button type="submit"
                            class="flex-1 px-10 py-6 bg-gradient-to-r from-emerald-500 to-teal-600 
                                   hover:from-emerald-600 hover:to-teal-700 text-white font-black text-2xl 
                                   rounded-3xl shadow-2xl hover:shadow-emerald-500/50 
                                   transform hover:-translate-y-1 transition-all duration-300 
                                   flex items-center justify-center gap-4 group">
                        Guardar información del proyecto
                        <svg class="w-8 h-8 group-hover:translate-x-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </button>

                    <a href="{{ route('equipos.show', $equipo) }}"
                       class="flex-1 px-10 py-6 bg-gradient-to-r from-gray-200 to-gray-300 
                              hover:from-gray-300 hover:to-gray-400 text-gray-800 font-black text-2xl 
                              rounded-3xl text-center shadow-2xl transform hover:scale-105 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection