{{-- resources/views/admin/usuarios/edit.blade.php --}}
@extends('layouts.master')

@section('title', 'Editar Usuario - ' . $usuario->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-16">
    <div class="max-w-5xl mx-auto px-6">

        <!-- Header Premium -->
        <div class="text-center mb-16">
            <h1 class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-6">
                Editar Usuario
            </h1>
            <p class="text-2xl text-gray-700 font-medium">
                Modifica toda la información del usuario con control total
            </p>
        </div>

        <!-- Botón volver -->
        <div class="mb-10">
            <a href="{{ route('admin.usuarios.show', $usuario) }}"
               class="inline-flex items-center gap-4 px-8 py-4 bg-white/80 backdrop-blur-xl text-indigo-600 font-black text-xl rounded-3xl hover:bg-indigo-50 transition transform hover:-translate-x-2 shadow-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al perfil
            </a>
        </div>

        <!-- Card Premium -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="p-10 lg:p-12">

                <!-- Mensajes de error -->
                @if($errors->any())
                    <div class="mb-8 bg-gradient-to-r from-red-100 to-rose-100 border-l-8 border-red-500 rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center gap-4">
                            <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="text-xl font-black text-red-800 mb-3">Errores encontrados:</p>
                                <ul class="list-disc pl-6 space-y-2 text-red-700 font-medium">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                    @csrf
                    @method('PATCH')

                    <!-- Foto de perfil + Info básica -->
                    <div class="grid lg:grid-cols-3 gap-10">
                        <!-- Foto -->
                        <div class="text-center">
                            <div class="relative inline-block">
                                <img src="{{ $usuario->foto_perfil ? Storage::url($usuario->foto_perfil) : asset('images/avatar.svg') }}"
                                     alt="{{ $usuario->name }}"
                                     class="w-48 h-48 rounded-3xl object-cover shadow-2xl ring-8 ring-purple-100">
                                
                                <label class="absolute bottom-0 right-0 bg-gradient-to-br from-purple-600 to-pink-600 text-white p-4 rounded-2xl shadow-xl cursor-pointer hover:shadow-2xl transition transform hover:scale-110">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <input type="file" name="foto_perfil" accept="image/*" class="hidden">
                                </label>
                            </div>
                            <p class="mt-4 text-lg font-bold text-gray-700">{{ $usuario->name }}</p>
                            <p class="text-gray-500">{{ $usuario->email }}</p>
                        </div>

                        <!-- Datos personales -->
                        <div class="lg:col-span-2 space-y-8">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Nombre completo</label>
                                    <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                                           class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                </div>

                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                                           class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Matrícula</label>
                                    <input type="text" name="matricula" value="{{ old('matricula', $usuario->matricula) }}"
                                           class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                           placeholder="201900123">
                                </div>

                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Teléfono</label>
                                    <input type="tel" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                                           class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                           placeholder="809-555-1234">
                                </div>

                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento?->format('Y-m-d')) }}"
                                           class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Carrera</label>
                                    <select name="carrera_id" class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                        <option value="">Seleccionar carrera...</option>
                                        @foreach(\App\Models\Carrera::orderBy('nombre')->get() as $carrera)
                                            <option value="{{ $carrera->id }}" {{ old('carrera_id', $usuario->carrera_id) == $carrera->id ? 'selected' : '' }}>
                                                {{ $carrera->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-lg font-bold text-gray-800 mb-3">Género</label>
                                    <select name="sexo" class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                        <option value="">Seleccionar...</option>
                                        <option value="M" {{ old('sexo', $usuario->sexo) === 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo', $usuario->sexo) === 'F' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('sexo', $usuario->sexo) === 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rol (más elegante) -->
                    <div class="mt-12 p-8 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-3xl">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Rol en la plataforma</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 gap-6">
                            @foreach($roles as $role)
                                <label class="relative flex items-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl cursor-pointer transition transform hover:-translate-y-1
                                    {{ $usuario->hasRole($role->name) ? 'ring-translate-y-1 ring-4 ring-purple-300' : '' }}">
                                    <input type="radio"
                                           name="role"
                                           value="{{ $role->name }}"
                                           {{ $usuario->hasRole($role->name) ? 'checked' : '' }}
                                           class="sr-only"
                                           required>
                                    <div class="flex-1">
                                        <p class="text-xl font-black text-gray-900">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            {{ $role->name === 'administrador' ? 'Acceso total' : 'Acceso limitado' }}
                                        </p>
                                    </div>
                                    <div class="w-8 h-8 rounded-full border-4 border-gray-300 group-hover:border-purple-500 transition
                                        {{ $usuario->hasRole($role->name) ? 'bg-purple-600 border-purple-600' : '' }}">
                                        <div class="w-full h-full rounded-full scale-0 bg-white transition-transform duration-300
                                            {{ $usuario->hasRole($role->name) ? 'scale-100' : '' }}"></div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Verificado -->
                    <div class="mt-10">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="verificado" value="1"
                                   {{ old('verificado', $usuario->verificado) ? 'checked' : '' }}
                                   class="w-8 h-8 text-purple-600 rounded-lg focus:ring-purple-500">
                            <span class="ml-4 text-xl font-bold text-gray-800">
                                Usuario verificado (correo confirmado + datos completos)
                            </span>
                        </label>
                    </div>

                    <!-- Botones finales -->
                    <div class="pt-12 border-t-4 border-purple-200 flex flex-col lg:flex-row gap-6">
                        <button type="submit"
                                class="flex-1 px-10 py-10 py-6 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-2xl rounded-3xl shadow-2xl hover:shadow-indigo-500/50 transform hover:-translate-y-2 transition-all duration-300 flex items-center justify-center gap-4 group">
                            Guardar todos los cambios
                            <svg class="w-10 h-10 group-hover:translate-x-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>

                        <a href="{{ route('admin.usuarios.show', $usuario) }}"
                           class="flex-1 px-10 py-6 bg-gradient-to-r from-gray-200 to-gray-300 text-gray-800 font-black text-2xl rounded-3xl text-center hover:from-gray-300 hover:to-gray-400 transition transform hover:scale-105 shadow-lg">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection