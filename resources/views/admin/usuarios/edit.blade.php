@extends('layouts.master')

@section('title', 'Editar Usuario')

@section('content')
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6"> <!-- Aumenté un poco el ancho -->
        <div class="mb-8">
            <a href="{{ route('admin.usuarios.show', $usuario) }}" class="text-indigo-600 hover:text-indigo-700 font-bold">
                ← Volver al usuario
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-10">
            <h1 class="text-3xl font-black text-gray-900 mb-8">Editar: {{ $usuario->name }}</h1>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')
                <input type="hidden" name="tab" value="{{ request()->query('tab') }}">

                <!-- Datos básicos -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nombre completo</label>
                        <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>
                </div>

                <!-- Datos del estudiante -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Matrícula</label>
                        <input type="text" name="matricula" value="{{ old('matricula', $usuario->matricula ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                               placeholder="Ej: 201900123">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $usuario->telefono ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                               placeholder="Ej: 809-555-1234">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Carrera</label>
                    <input type="text" name="carrera" value="{{ old('carrera', $usuario->carrera ?? '') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100"
                           placeholder="Ej: Ingeniería en Sistemas">
                </div>

                <!-- Rol (único) -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-4">Rol</label>
                    <div class="space-y-3">
                        @foreach($roles as $role)
                            <div class="flex items-center">
                                <input type="radio" 
                                       name="role" 
                                       value="{{ $role->name }}" 
                                       {{ $usuario->hasRole($role->name) ? 'checked' : '' }}
                                       class="w-5 h-5 text-indigo-600 border-gray-300 focus:ring-indigo-500 cursor-pointer" 
                                       id="role_{{ $role->id }}"
                                       required>
                                <label for="role_{{ $role->id }}" class="ml-3 cursor-pointer select-none">
                                    <span class="font-bold text-gray-900">{{ ucfirst(str_replace('_', ' ', $role->name)) }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botones -->
                <div class="pt-8 border-t border-gray-200 flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition transform hover:scale-105">
                        Guardar todos los cambios
                    </button>
                    <a href="{{ route('admin.usuarios.show', $usuario) }}" class="flex-1 px-6 py-4 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection