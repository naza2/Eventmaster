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

            <div class="bg-white rounded-2xl shadow-xl p-8" x-data="{ selected: '{{ old('especialidad', '') }}' }">
                <form method="POST" action="{{ route('especialidad.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-4">
                            Especialidad *
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($especialidades as $value => $label)
                                <div x-data="{ value: '{{ $value }}' }">
                                    <label :class="selected === value ? 'border-purple-600 bg-purple-50 ring-2 ring-purple-300' : 'border-gray-200'"
                                        class="relative flex items-center p-4 border-2 rounded-xl cursor-pointer hover:border-purple-500 transition-all group">
                                        <input
                                            type="radio"
                                            name="especialidad"
                                            value="{{ $value }}"
                                            class="sr-only"
                                            :checked="selected === value"
                                            @change="selected = value"
                                            required>

                                        <div class="flex items-center gap-3 w-full">
                                            <!-- Icono de la especialidad -->
                                            <div class="flex-shrink-0">
                                                @if($value === 'sistemas')
                                                    <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M20 3H4c-1.11 0-2 .89-2 2v11c0 1.11.89 2 2 2h3l-1 1v2h12v-2l-1-1h3c1.11 0 2-.89 2-2V5c0-1.11-.89-2-2-2zm0 13H4V5h16v11z"/>
                                                    </svg>
                                                @elseif($value === 'quimica')
                                                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M7 2v2h1v14c0 2.21 1.79 4 4 4s4-1.79 4-4V4h1V2H7zm4 14c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm2-4c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm1-5h-4V4h4v3z"/>
                                                    </svg>
                                                @elseif($value === 'civil')
                                                    <svg class="w-8 h-8 text-orange-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm0 2.5l6 5.5v8h-2v-6H8v6H6v-8l6-5.5z"/>
                                                    </svg>
                                                @elseif($value === 'licenciatura')
                                                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/>
                                                    </svg>
                                                @elseif($value === 'fisica')
                                                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                        <circle cx="12" cy="12" r="3"/>
                                                    </svg>
                                                @elseif($value === 'gestion_proyectos')
                                                    <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1c-1.3 0-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                                    </svg>
                                                @endif
                                            </div>

                                            <!-- Indicador de selección -->
                                            <div :class="selected === value ? 'border-purple-600 bg-purple-600' : 'border-gray-300'"
                                                class="flex-shrink-0 w-6 h-6 border-2 rounded-full flex items-center justify-center transition">
                                                <svg x-show="selected === value"
                                                    x-transition
                                                    class="w-3 h-3 text-white"
                                                    fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>

                                            <!-- Texto -->
                                            <span :class="selected === value ? 'text-purple-600 font-bold' : 'text-gray-700'"
                                                class="font-medium group-hover:text-purple-600 transition">
                                                {{ $label }}
                                            </span>
                                        </div>
                                    </label>
                                </div>
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
