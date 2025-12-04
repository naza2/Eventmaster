@extends('layouts.app')

@section('title', 'Editar proyecto - ' . $proyecto->equipo->nombre_proyecto)

@section('content')
<!-- HERO EDITAR PROYECTO -->
<section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Editar proyecto
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Actualiza la información de <strong class="text-yellow-300">{{ $proyecto->equipo->nombre_proyecto }}</strong>
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-xl font-bold">
                Evento: {{ $proyecto->equipo->evento->nombre }}
            </span>
        </div>
    </div>
</section>

<!-- FORMULARIO DE EDICIÓN -->
<section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-10 text-white">
                <h2 class="text-4xl font-black mb-4">¡Perfecciona tu proyecto!</h2>
                <p class="text-xl opacity-90">
                    Aquí puedes actualizar todos los detalles técnicos y enlaces de tu proyecto
                </p>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('proyecto.update', $proyecto) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    @method('PUT')

                    <!-- PROBLEMA QUE RESUELVE -->
                    <div>
                        <label for="problema_resuelto" class="block text-xl font-bold text-gray-800 mb-4">
                            ¿Qué problema resuelve tu proyecto? *
                        </label>
                        <textarea name="problema_resuelto" id="problema_resuelto" rows="5" required
                                  class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg @error('problema_resuelto') border-red-500 @enderror"
                                  placeholder="Describe claramente el problema real que tu solución aborda...">{{ old('problema_resuelto', $proyecto->problema_resuelto) }}</textarea>
                        @error('problema_resuelto')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SOLUCIÓN PROPUESTA -->
                    <div>
                        <label for="solucion_propuesta" class="block text-xl font-bold text-gray-800 mb-4">
                            ¿Cómo lo resuelve tu proyecto? *
                        </label>
                        <textarea name="solucion_propuesta" id="solucion_propuesta" rows="6" required
                                  class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg @error('solucion_propuesta') border-red-500 @enderror"
                                  placeholder="Explica tu solución técnica, innovaciones, tecnologías usadas...">{{ old('solucion_propuesta', $proyecto->solucion_propuesta) }}</textarea>
                        @error('solucion_propuesta')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IMPACTO SOCIAL (opcional pero recomendado) -->
                    <div>
                        <label for="impacto_social" class="block text-xl font-bold text-gray-800 mb-4">
                            Impacto social o beneficio (opcional)
                        </label>
                        <textarea name="impacto_social" id="impacto_social" rows="4"
                                  class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                  placeholder="¿Cómo mejora la vida de las personas? ¿Qué cambio genera?">{{ old('impacto_social', $proyecto->impacto_social) }}</textarea>
                    </div>

                    <!-- REPOSITORIO Y ENLACES -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-10 border border-gray-200">
                        <h3 class="text-3xl font-black text-gray-900 mb-10">Enlaces del proyecto</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- GitHub -->
                            <div>
                                <label for="github" class="block text-lg font-bold text-gray-700 mb-3">
                                    Repositorio GitHub
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.05 1.334.918 1.334.918 1.072 1.518 2.818 1.072 2.818 1.072.964.789.638.689.5.009.546-.419.546-.419-.589-.247-1.214-.881-1.214-.881-1.98-.331-2.441-.331-2.441-.331-.331 2.205-.883 2.205-.883 2.441.165 4.18 2.363 4.18 2.363 2.166 3.72 5.684 2.647 7.07 2.029.224-.629.874-1.06 1.59-1.305-3.622-.414-7.426-1.81-7.426-8.051 0-1.779.636-3.233 1.68-4.373-.168-.414-.727-2.068.16-4.31 0 0 1.37-.439 4.49 1.672 1.304-.363 2.698-.545 4.087-.552 1.388.007 2.784.19 4.091.552 3.117-2.111 4.484-1.672 4.484-1.672.889 2.242.329 3.896.161 4.31 1.046 1.14 1.679 2.594 1.679 4.373 0 6.258-3.809 7.635-7.438 8.04.585.503 1.106 1.496 1.106 3.015 0 2.175-.02 3.928-.02 4.463 0 .319.192.694.801.577 4.767-1.589 8.202-6.086 8.202-11.387 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                    </div>
                                    <input type="url" name="github" id="github"
                                           value="{{ old('github', $proyecto->repositorio?->github) }}"
                                           class="w-full pl-16 pr-6 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                           placeholder="https://github.com/tuusuario/proyecto">
                                </div>
                            </div>

                            <!-- Demo -->
                            <div>
                            <div>
                                <label for="demo" class="block text-lg font-bold text-gray-700 mb-3">
                                    Demo en vivo
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                        </svg>
                                    </div>
                                    <input type="url" name="demo" id="demo"
                                           value="{{ old('demo', $proyecto->repositorio?->demo) }}"
                                           class="w-full pl-16 pr-6 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                           placeholder="https://tu-proyecto.vercel.app">
                                </div>
                            </div>

                            <!-- Video Pitch -->
                            <div>
                                <label for="video_pitch" class="block text-lg font-bold text-gray-700 mb-3">
                                    Video Pitch (YouTube/Vimeo)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12 9.545 15.568z"/>
                                        </svg>
                                    </div>
                                    <input type="url" name="video_pitch" id="video_pitch"
                                           value="{{ old('video_pitch', $proyecto->repositorio?->video_pitch) }}"
                                           class="w-full pl-16 pr-6 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                           placeholder="https://youtube.com/watch?v=...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center pt-12">
                        <a href="{{ route('equipos.show', $proyecto->equipo) }}"
                           class="px-12 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition text-center">
                            ← Cancelar
                        </a>
                        <button type="submit"
                                class="px-16 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-green-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                            Guardar cambios del proyecto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection