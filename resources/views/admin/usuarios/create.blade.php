@php
    $title = 'Crear Usuario';
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.usuarios.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a usuarios
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-8 py-6">
                    <h1 class="text-3xl font-black text-white">
                        Crear Nuevo Usuario
                    </h1>
                    <p class="text-purple-100 mt-2">
                        Completa el formulario para crear un nuevo usuario y asignar sus roles
                    </p>
                </div>

                <form method="POST" action="{{ route('admin.usuarios.store') }}" class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                                Nombre Completo *
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                                Correo Electrónico *
                            </label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                                Contraseña *
                            </label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition"
                                   required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">
                                Confirmar Contraseña *
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition"
                                   required>
                        </div>

                        <!-- Matrícula -->
                        <div>
                            <label for="matricula" class="block text-sm font-bold text-gray-700 mb-2">
                                Matrícula
                            </label>
                            <input type="text"
                                   name="matricula"
                                   id="matricula"
                                   value="{{ old('matricula') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition">
                            @error('matricula')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="telefono" class="block text-sm font-bold text-gray-700 mb-2">
                                Teléfono
                            </label>
                            <input type="text"
                                   name="telefono"
                                   id="telefono"
                                   value="{{ old('telefono') }}"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition">
                            @error('telefono')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Carrera -->
                    <div>
                        <label for="carrera_id" class="block text-sm font-bold text-gray-700 mb-2">
                            Carrera *
                        </label>
                        <select name="carrera_id"
                                id="carrera_id"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition"
                                required>
                            <option value="">Selecciona una carrera</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('carrera_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Roles -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">
                            Roles *
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($roles as $role)
                                <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer hover:border-purple-500 transition-all
                                    {{ in_array($role->name, old('roles', [])) ? 'border-purple-600 bg-purple-50' : 'border-gray-200' }}">
                                    <input type="checkbox"
                                           name="roles[]"
                                           value="{{ $role->name }}"
                                           class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                                           {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                    <span class="ml-3 text-gray-700 font-medium">
                                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                        @error('roles')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button type="submit"
                                class="flex-1 px-6 py-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-[1.02]">
                            Crear Usuario
                        </button>
                        <a href="{{ route('admin.usuarios.index') }}"
                           class="px-6 py-4 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition text-center">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
