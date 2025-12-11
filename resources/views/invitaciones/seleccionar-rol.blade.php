@php
    $title = 'Seleccionar Rol en el Equipo';
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-4xl font-black text-gray-900 mb-3">
                    ¡Selecciona tu rol en el equipo!
                </h1>
                <p class="text-lg text-gray-600">
                    Antes de unirte, dinos qué función cumplirás en el equipo
                </p>
            </div>

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Información del equipo -->
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-white">
                                {{ $equipo->nombre_equipo }}
                            </h2>
                            <p class="text-purple-100 font-semibold">
                                {{ $equipo->evento->nombre }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Formulario de selección de rol -->
                <form method="POST" action="{{ route('invitaciones.guardar-rol', $invitacion) }}" class="p-8">
                    @csrf

                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-900 mb-4">
                            ¿Qué rol desempeñarás en el equipo?
                        </label>

                        <div class="space-y-3">
                            <!-- Líder -->
                            <label class="flex items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-xl cursor-pointer border-2 border-transparent hover:border-purple-300 transition">
                                <input type="radio" name="rol" value="lider" required
                                       class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Líder</span>
                                    <span class="block text-sm text-gray-600">Coordinas y diriges al equipo</span>
                                </div>
                            </label>

                            <!-- Programador -->
                            <label class="flex items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-xl cursor-pointer border-2 border-transparent hover:border-purple-300 transition">
                                <input type="radio" name="rol" value="programador" required
                                       class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Programador</span>
                                    <span class="block text-sm text-gray-600">Desarrollas el código del proyecto</span>
                                </div>
                            </label>

                            <!-- Diseñador -->
                            <label class="flex items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-xl cursor-pointer border-2 border-transparent hover:border-purple-300 transition">
                                <input type="radio" name="rol" value="diseñador" required
                                       class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Diseñador</span>
                                    <span class="block text-sm text-gray-600">Creas la interfaz y experiencia visual</span>
                                </div>
                            </label>

                            <!-- Analista de Negocios -->
                            <label class="flex items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-xl cursor-pointer border-2 border-transparent hover:border-purple-300 transition">
                                <input type="radio" name="rol" value="analista_negocios" required
                                       class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Analista de Negocios</span>
                                    <span class="block text-sm text-gray-600">Defines requisitos y estrategia del proyecto</span>
                                </div>
                            </label>

                            <!-- Analista de Datos -->
                            <label class="flex items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-xl cursor-pointer border-2 border-transparent hover:border-purple-300 transition">
                                <input type="radio" name="rol" value="analista_datos" required
                                       class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Analista de Datos</span>
                                    <span class="block text-sm text-gray-600">Trabajas con datos y estadísticas</span>
                                </div>
                            </label>

                            <!-- Otro -->
                            <label class="flex items-center p-4 bg-gray-50 hover:bg-purple-50 rounded-xl cursor-pointer border-2 border-transparent hover:border-purple-300 transition">
                                <input type="radio" name="rol" value="otro" required
                                       class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                                <div class="ml-4">
                                    <span class="block font-bold text-gray-900">Otro</span>
                                    <span class="block text-sm text-gray-600">Otra función en el equipo</span>
                                </div>
                            </label>
                        </div>

                        @error('rol')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit"
                                class="flex-1 px-6 py-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-lg rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition">
                            Unirme al equipo
                        </button>

                        <a href="{{ route('invitaciones.index') }}"
                           class="px-6 py-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition text-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Nota informativa -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                <div class="flex">
                    <svg class="h-5 w-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm text-blue-700">
                        <strong>Nota:</strong> Este rol describe tu función principal en el equipo. Podrás colaborar en otras áreas según lo necesite el proyecto.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
