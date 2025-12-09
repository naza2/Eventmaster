{{-- resources/views/admin/usuarios/create.blade.php --}}
@php
    $title = 'Crear Nuevo Usuario';
@endphp

<x-app-layout>
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 py-16">
    <div class="max-w-5xl mx-auto px-6">

        <!-- Header Premium -->
        <div class="text-center mb-16">
            <h1 class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 mb-6">
                Crear Nuevo Usuario
            </h1>
            <p class="text-2xl text-gray-700 font-medium">
                Completa todos los campos para registrar un nuevo perfil en EventMaster
            </p>
        </div>

        <!-- Botón volver -->
        <div class="mb-10">
            <a href="{{ route('admin.usuarios.index') }}"
               class="inline-flex items-center gap-4 px-8 py-5 bg-white/90 backdrop-blur-xl text-purple-600 font-black text-xl rounded-3xl hover:bg-purple-50 transition transform hover:-translate-x-2 shadow-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a usuarios
            </a>
        </div>

        <!-- Card Premium -->
        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 px-10 py-12 text-white text-center">
                <h2 class="text-5xl font-black mb-4">Registro Administrativo</h2>
                <p class="text-xl opacity-90">Crea cuentas manualmente con todos los privilegios</p>
            </div>

            <form method="POST" action="{{ route('admin.usuarios.store') }}" enctype="multipart/form-data" class="p-10 lg:p-14 space-y-10">
                @csrf

                <!-- Mensajes de error -->
                @if($errors->any())
                    <div class="bg-gradient-to-r from-red-100 to-rose-100 border-l-8 border-red-500 rounded-2xl p-8 shadow-xl">
                        <div class="flex items-center gap-6">
                            <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="text-2xl font-black text-red-800 mb-4">Errores encontrados:</p>
                                <ul class="space-y-2 text-red-700 font-bold">
                                    @foreach($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

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

                <!-- Formulario en 2 columnas -->
                <div class="grid lg:grid-cols-2 gap-10">

                    <!-- Columna 1 -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Nombre completo *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="Juan Carlos Pérez">
                            @error('name') <p class="mt-2 text-red-600 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Correo electrónico *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="juan@itesm.mx">
                            @error('email') <p class="mt-2 text-red-600 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Matrícula</label>
                            <input type="text" name="matricula" value="{{ old('matricula') }}"
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="A01234567">
                            @error('matricula') <p class="mt-2 text-red-600 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Teléfono</label>
                            <input type="tel" name="telefono" value="{{ old('telefono') }}"
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="809-555-1234">
                            @error('telefono') <p class="mt-2 text-red-600 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Columna 2 -->
                    <div class="space-y-8">
                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Contraseña *</label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="Mínimo 8 caracteres">
                            @error('password') <p class="mt-2 text-red-600 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Confirmar contraseña *</label>
                            <input type="password" name="password_confirmation" required
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                   placeholder="Repite la contraseña">
                        </div>

                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Carrera *</label>
                            <select name="carrera_id" required
                                    class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                <option value="">Seleccionar carrera...</option>
                                @foreach($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera_id') <p class="mt-2 text-red-600 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-xl font-bold text-gray-800 mb-3">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                   class="w-full px-6 py-5 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                        </div>
                    </div>
                </div>

                <!-- Roles Premium - Versión MÁS PEQUEÑA -->
                <div class="mt-8 p-6 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200">
                    <h3 class="text-xl font-black text-gray-900 mb-5 text-center">Asignar Roles</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($roles as $role)
                            <div x-data="{ selected: {{ in_array($role->name, old('roles', [])) ? 'true' : 'false' }} }">
                                <label @click="selected = !selected"
                                    :class="selected ? 'ring-4 ring-purple-400 bg-purple-50' : 'ring-2 ring-gray-200'"
                                    class="relative flex flex-col items-center p-4 bg-white rounded-2xl shadow-lg cursor-pointer hover:shadow-xl transition transform hover:-translate-y-1">
                                    <input type="checkbox"
                                        name="roles[]"
                                        value="{{ $role->name }}"
                                        class="sr-only"
                                        :checked="selected"
                                        @change="selected = $event.target.checked">

                                    <div class="text-4xl mb-3">
                                        @if($role->name === 'administrador')
                                            <svg class="w-10 h-10 text-purple-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        @elseif($role->name === 'participante')
                                            <svg class="w-10 h-10 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422A12.083 12.083 0 0112 21.5c-2.4 0-4.6-.7-6.5-2.1L12 14z"/></svg>
                                        @else
                                            <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
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

                <!-- Botones finales - Versión PEQUEÑA, BONITA y PROFESIONAL -->
                <div class="pt-10 flex flex-col sm:flex-row gap-4">
                    <!-- Botón Crear -->
                    <button type="submit"
                            class="flex-1 px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 
                                hover:from-purple-700 hover:to-pink-700 
                                text-white font-bold text-lg rounded-2xl 
                                shadow-xl hover:shadow-purple-500/50 
                                transform hover:-translate-y-1 
                                transition-all duration-300 
                                flex items-center justify-center gap-3 group">
                        Crear Usuario
                        <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" 
                                d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('admin.usuarios.index') }}"
                    class="flex-1 px-8 py-4 bg-gradient-to-r from-gray-200 to-gray-300 
                            hover:from-gray-300 hover:to-gray-400 
                            text-gray-800 font-bold text-lg rounded-2xl 
                            text-center shadow-lg hover:shadow-xl 
                            transform hover:scale-105 
                            transition-all duration-300">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>