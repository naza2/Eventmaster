@php
    $title = 'Selecciona tu Especialidad';
@endphp

<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-gray-900 mb-3">
                    ¡Bienvenido Juez!
                </h1>
                <p class="text-lg text-gray-600">
                    Para continuar, por favor selecciona tu área de especialidad
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form method="POST" action="{{ route('especialidad.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-4">
                            Especialidad *
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($especialidades as $value => $label)
                                <label class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer hover:border-purple-500 transition-all group
                                    {{ old('especialidad') == $value ? 'border-purple-600 bg-purple-50' : 'border-gray-200' }}">
                                    <input
                                        type="radio"
                                        name="especialidad"
                                        value="{{ $value }}"
                                        class="sr-only peer"
                                        {{ old('especialidad') == $value ? 'checked' : '' }}
                                        required>

                                    <div class="flex items-center gap-3 w-full">
                                        <div class="flex-shrink-0 w-6 h-6 border-2 rounded-full border-gray-300 peer-checked:border-purple-600 peer-checked:bg-purple-600 flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium group-hover:text-purple-600 peer-checked:text-purple-600">
                                            {{ $label }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('especialidad')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full px-6 py-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                            Guardar Especialidad
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">
                    Esta información es necesaria para asignarte proyectos relacionados con tu área de expertise.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
