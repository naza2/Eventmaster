{{-- resources/views/admin/usuarios/edit.blade.php --}}
@extends('layouts.master')

@section('title', 'Editar Usuario - ' . $usuario->name)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-4xl mx-auto px-6">

        <!-- Header compacto -->
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                Editar Usuario
            </h1>

            <a href="{{ route('admin.usuarios.show', $usuario) }}"
               class="inline-flex items-center gap-3 px-6 py-3 bg-white/80 backdrop-blur-xl text-indigo-600 font-bold text-lg rounded-2xl hover:bg-indigo-50 transition shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver
            </a>
        </div>

        <!-- Card principal -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="p-8 lg:p-10">

                <!-- Mensajes de error -->
                @if($errors->any())
                    <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-5 shadow-lg">
                        <div class="flex items-center gap-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="font-black text-red-800">Errores encontrados:</p>
                                <ul class="mt-2 space-y-1 text-red-700">
                                    @foreach($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- Foto + Datos básicos -->
                    <div class="grid lg:grid-cols-3 gap-8 items-start">
                        <!-- Foto de perfil -->
                        <!-- Foto de perfil - Versión COMPACTA y ELEGANTE -->
                <div class="mb-10">
                    <h3 class="text-xl font-black text-gray-900 mb-6 text-center">
                        Foto de perfil <span class="text-gray-500 font-normal">(opcional)</span>
                    </h3>

                    <div x-data="{ 
                        preview: '{{ old('foto_perfil', $usuario->foto_perfil ?? '') }}',
                        hasPreview: function() { return this.preview !== '' }
                    }" class="max-w-md mx-auto">

                        <!-- Vista previa pequeña y bonita -->
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-xl ring-8 ring-purple-100 bg-gradient-to-br from-purple-200 to-pink-200">
                                    <template x-if="preview">
                                        <img :src="preview" alt="Vista previa" class="w-full h-full object-cover">
                                    </template>
                                    <template x-if="!preview">
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    </template>
                                </div>

                                <!-- Indicador de foto cargada -->
                                <div x-show="preview" class="absolute -bottom-2 -right-2">
                                    <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Opciones compactas en fila -->
                        <div class="grid grid-cols-2 gap-4">

                            <!-- Subir archivo -->
                            <label class="cursor-pointer">
                                <input type="file"
                                    name="foto_perfil"
                                    accept="image/*"
                                    class="hidden"
                                    @change="let file = $event.target.files[0];
                                                if(file){
                                                    let reader = new FileReader();
                                                    reader.onload = (e) => preview = e.target.result;
                                                    reader.readAsDataURL(file);
                                                }">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-2xl text-center transition transform hover:scale-105 shadow-lg">
                                    Subir foto
                                </div>
                            </label>

                            <!-- Pegar URL -->
                            <div class="relative">
                                <input type="url"
                                    name="foto_url"
                                    placeholder="o pega un enlace"
                                    class="w-full pl-12 pr-4 py-4 text-sm rounded-2xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition"
                                    @input.debounce.500ms="preview = $event.target.value"
                                    value="{{ old('foto_url') }}">

                                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4 1.414 1.414L9.172 12 5.586 8.414 7 7l4 4 4-4 1.414 1.414-4 4z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.414l-6.414-6.414L7 13.586 12 18.586l5-5L18.414 15l-6.414 6.414z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Nota pequeña -->
                        <p class="text-center mt-4 text-xs text-gray-500">
                            JPG, PNG, WebP • Máx 5MB • Cuadrada recomendada
                        </p>
                    </div>
                </div>

                        <!-- Formulario -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-base font-bold text-gray-800 mb-2">Nombre completo</label>
                                    <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                                           class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-800 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                                           class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-800 mb-2">Matrícula</label>
                                    <input type="text" name="matricula" value="{{ old('matricula', $usuario->matricula) }}"
                                           class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-800 mb-2">Teléfono</label>
                                    <input type="tel" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                                           class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-800 mb-2">Carrera</label>
                                    <select name="carrera_id" class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                                        <option value="">Seleccionar...</option>
                                        @foreach(\App\Models\Carrera::orderBy('nombre')->get() as $carrera)
                                            <option value="{{ $carrera->id }}" {{ old('carrera_id', $usuario->carrera_id) == $carrera->id ? 'selected' : '' }}>
                                                {{ $carrera->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-800 mb-2">Género</label>
                                    <select name="sexo" class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                                        <option value="">Seleccionar...</option>
                                        <option value="M" {{ old('sexo', $usuario->sexo) === 'M' ? 'selected' : '' }}>Masculino</option>
                                        <option value="F" {{ old('sexo', $usuario->sexo) === 'F' ? 'selected' : '' }}>Femenino</option>
                                        <option value="Otro" {{ old('sexo', $usuario->sexo) === 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-base font-bold text-gray-800 mb-2">Fecha de nacimiento</label>
                                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento?->format('Y-m-d')) }}"
                                       class="w-full px-5 py-3 text-base border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition">
                            </div>
                        </div>
                    </div>

                    <!-- Roles Premium - Versión MÁS PEQUEÑA -->
                    <div class="mt-8 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200">
                        <h3 class="text-xl font-black text-gray-900 mb-5 text-center">Asignar Roles</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($roles as $role)
                                @php
                                    $userRoles = old('roles', $usuario->roles->pluck('name')->toArray());
                                @endphp
                                <div x-data="{ selected: {{ in_array($role->name, $userRoles) ? 'true' : 'false' }} }">
                                    <label :class="selected ? 'ring-4 ring-purple-400 bg-purple-50' : 'ring-2 ring-gray-200'"
                                        class="relative flex flex-col items-center p-4 bg-white rounded-2xl shadow-lg cursor-pointer hover:shadow-xl transition transform hover:-translate-y-1">
                                        <input type="checkbox"
                                            name="roles[]"
                                            value="{{ $role->name }}"
                                            class="sr-only"
                                            :checked="selected"
                                            @change="selected = $event.target.checked">

                                        <div class="text-4xl mb-3">
                                            @if($role->name === 'administrador')
                                                <svg class="w-12 h-12 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                                </svg>
                                            @elseif($role->name === 'participante' || $role->name === 'usuario')
                                                <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                                                </svg>
                                            @elseif($role->name === 'lider_equipo')
                                                <svg class="w-12 h-12 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                            @elseif($role->name === 'juez')
                                                <svg class="w-12 h-12 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                            @else
                                                <svg class="w-12 h-12 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                            @endif
                                        </div>

                                        <p class="text-base font-black text-gray-900">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </p>

                                        <div :class="selected ? 'bg-purple-600 border-purple-600' : 'border-gray-300'"
                                            class="mt-3 w-8 h-8 rounded-full border-3 transition flex items-center justify-center">
                                            <svg x-show="selected"
                                                x-transition
                                                class="w-5 h-5 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="3"
                                                    d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <p class="mt-3 text-center text-red-600 font-bold text-lg">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Verificado -->
                    <div class="mt-8">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="verificado" value="1"
                                   {{ old('verificado', $usuario->verificado) ? 'checked' : '' }}
                                   class="w-6 h-6 text-purple-600 rounded focus:ring-purple-500">
                            <span class="ml-3 text-base font-bold text-gray-800">
                                Usuario verificado
                            </span>
                        </label>
                    </div>

                    <!-- Botones finales pequeños -->
                    <div class="pt-8 flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                                class="flex-1 px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 
                                       hover:from-purple-700 hover:to-pink-700 
                                       text-white font-bold text-lg rounded-2xl 
                                       shadow-xl hover:shadow-purple-500/50 
                                       transform hover:-translate-y-1 
                                       transition-all duration-300 
                                       flex items-center justify-center gap-3 group">
                            Guardar cambios
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>

                        <a href="{{ route('admin.usuarios.show', $usuario) }}"
                           class="flex-1 px-8 py-4 bg-gray-200 hover:bg-gray-300 
                                  text-gray-800 font-bold text-lg rounded-2xl 
                                  text-center shadow-lg hover:shadow-xl 
                                  transition transform hover:scale-105">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
