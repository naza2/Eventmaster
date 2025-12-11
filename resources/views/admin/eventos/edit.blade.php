@extends('layouts.master')

@section('title', 'Editar Evento - ' . $evento->nombre)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-5xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-6">
                Editar Evento
            </h1>
            <p class="text-2xl text-gray-700 font-medium">
                Modifica todos los detalles del evento con control total
            </p>
        </div>

        <div class="mb-10">
            <a href="{{ route('admin.eventos.show', $evento) }}"
               class="inline-flex items-center gap-4 px-8 py-5 bg-white/90 backdrop-blur-xl text-indigo-600 font-black text-xl rounded-3xl hover:bg-indigo-50 transition transform hover:-translate-x-2 shadow-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al evento
            </a>
        </div>

        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="p-10 lg:p-14">

                @if($errors->any())
                    <div class="mb-10 bg-gradient-to-r from-red-100 to-rose-100 border-l-8 border-red-500 rounded-2xl p-8 shadow-xl">
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

                <form action="{{ route('admin.eventos.update', $evento) }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                    @csrf
                    @method('PATCH')

                    <div class="mb-10">
                        <h3 class="text-xl font-black text-gray-900 mb-6 text-center">
                            Banner del evento <span class="text-gray-500 font-normal">(opcional)</span>
                        </h3>

                        <div x-data="{
                            preview: '{{ old('banner', $evento->banner ? (filter_var($evento->banner, FILTER_VALIDATE_URL) ? $evento->banner : Storage::url($evento->banner)) : '') }}'
                        }" class="max-w-2xl mx-auto">

                            <div class="flex justify-center mb-6">
                                <div class="relative">
                                    <div class="w-96 h-48 rounded-2xl overflow-hidden shadow-xl ring-8 ring-purple-100 bg-gradient-to-br from-indigo-200 to-pink-200">
                                        <template x-if="preview">
                                            <img :src="preview" alt="Banner del evento" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!preview">
                                            <div class="w-full h-full flex items-center justify-center">
                                                <p class="text-white text-5xl font-black opacity-50">
                                                    {{ Str::upper(substr($evento->nombre, 0, 3)) }}
                                                </p>
                                            </div>
                                        </template>
                                    </div>

                                    <div x-show="preview" class="absolute -bottom-2 -right-2">
                                        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">

                                <label class="cursor-pointer">
                                    <input type="file"
                                        name="banner"
                                        accept="image/*"
                                        class="hidden"
                                        @change="let file = $event.target.files[0];
                                                    if(file){
                                                        let reader = new FileReader();
                                                        reader.onload = (e) => preview = e.target.result;
                                                        reader.readAsDataURL(file);
                                                    }">
                                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-2xl text-center transition transform hover:scale-105 shadow-lg">
                                        Subir banner
                                    </div>
                                </label>

                                <div class="relative">
                                    <input type="url"
                                        name="banner_url"
                                        placeholder="o pega un enlace"
                                        class="w-full pl-12 pr-4 py-4 text-sm rounded-2xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition"
                                        @input.debounce.500ms="preview = $event.target.value"
                                        value="{{ old('banner_url') }}">

                                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4 1.414 1.414L9.172 12 5.586 8.414 7 7l4 4 4-4 1.414 1.414-4 4z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.414l-6.414-6.414L7 13.586 12 18.586l5-5L18.414 15l-6.414 6.414z"/>
                                    </svg>
                                </div>
                            </div>

                            <p class="text-center mt-4 text-xs text-gray-500">
                                Recomendado: 1600×400px • JPG, PNG, WebP • Máx 5MB
                            </p>
                        </div>
                    </div>


                    <div class="grid lg:grid-cols-2 gap-10">

                        <div class="space-y-8">
                            <div>
                                <label class="block text-xl font-bold text-gray-800 mb-4">Nombre del evento *</label>
                                <input type="text" name="nombre" value="{{ old('nombre', $evento->nombre) }}" required
                                       class="w-full px-8 py-6 text-xl border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                            </div>

                            <div>
                                <label class="block text-xl font-bold text-gray-800 mb-4">Descripción</label>
                                <textarea name="descripcion" rows="6"
                                          class="w-full px-8 py-6 text-lg border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition resize-none"
                                          placeholder="Describe el evento, premios, reglas, etc...">{{ old('descripcion', $evento->descripcion) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xl font-bold text-gray-800 mb-4">Máximo de miembros por equipo</label>
                                <input type="number" name="max_miembros" value="{{ old('max_miembros', $evento->max_miembros) }}" min="1"
                                       class="w-full px-8 py-6 text-xl border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                                       placeholder="Ej: 4">
                            </div>
                        </div>

                        <div class="space-y-8">
                            <div>
                                <label class="block text-xl font-bold text-gray-800 mb-4">Fecha y hora de inicio *</label>
                                <input type="datetime-local" name="fecha_inicio"
                                       value="{{ old('fecha_inicio', $evento->fecha_inicio->format('Y-m-d\TH:i')) }}" required
                                       class="w-full px-8 py-6 text-xl border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                            </div>

                            <div>
                                <label class="block text-xl font-bold text-gray-800 mb-4">Fecha y hora de fin *</label>
                                <input type="datetime-local" name="fecha_fin"
                                       value="{{ old('fecha_fin', $evento->fecha_fin->format('Y-m-d\TH:i')) }}" required
                                       class="w-full px-8 py-6 text-xl border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                            </div>

                            <div>
                                <label class="block text-xl font-bold text-gray-800 mb-4">Estado del evento *</label>
                                <select name="estado" required
                                        class="w-full px-8 py-6 text-xl border-2 border-gray-200 rounded-2xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition">
                                    <option value="inscripcion" {{ old('estado', $evento->estado) === 'inscripcion' ? 'selected' : '' }}>
                                        Inscripción abierta
                                    </option>
                                    <option value="en_curso" {{ old('estado', $evento->estado) === 'en_curso' ? 'selected' : '' }}>
                                        En curso
                                    </option>
                                    <option value="finalizado" {{ old('estado', $evento->estado) === 'finalizado' ? 'selected' : '' }}>
                                        Finalizado
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Jueces -->
                    <div class="pt-10 border-t-2 border-purple-100">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Jueces Asignados</h3>
                        <div class="space-y-4">
                            @if($jueces->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($jueces as $juez)
                                        <label class="flex items-center gap-3 p-4 border-2 border-gray-200 rounded-xl hover:border-purple-400 cursor-pointer transition-all">
                                            <input type="checkbox"
                                                   name="jueces[]"
                                                   value="{{ $juez->id }}"
                                                   {{ in_array($juez->id, $juecesAsignados) ? 'checked' : '' }}
                                                   class="w-5 h-5 text-purple-600 rounded focus:ring-purple-500">
                                            <div class="flex-1">
                                                <p class="font-bold text-gray-900">{{ $juez->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $juez->email }}</p>
                                                @if($juez->especialidad)
                                                    <p class="text-xs text-purple-600 mt-1 capitalize">
                                                        {{ str_replace('_', ' ', $juez->especialidad) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 bg-gray-50 rounded-2xl">
                                    <p class="text-gray-600 font-medium">No hay jueces disponibles en el sistema</p>
                                    <p class="text-sm text-gray-500 mt-2">Primero debes crear usuarios con rol de juez</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sección de Equipos Inscritos -->
                    <div class="pt-10 border-t-2 border-purple-100">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">
                            Equipos Inscritos ({{ $evento->equipos->count() }})
                        </h3>

                        @if($evento->equipos->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($evento->equipos as $equipo)
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border-2 border-gray-200">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex-1">
                                                <h4 class="text-xl font-black text-gray-900 mb-1">
                                                    {{ $equipo->nombre_equipo }}
                                                </h4>
                                                <p class="text-purple-600 font-bold">
                                                    {{ $equipo->nombre_proyecto }}
                                                </p>
                                            </div>
                                            @if($equipo->participantes->where('es_lider', true)->first())
                                                <span class="px-3 py-1 bg-gradient-to-r from-yellow-400 to-amber-500 text-white font-bold text-xs rounded-full">
                                                    LÍDER
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-red-500 text-white font-bold text-xs rounded-full">
                                                    SIN LÍDER
                                                </span>
                                            @endif
                                        </div>

                                        <div class="space-y-2 mb-4">
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Miembros:</span>
                                                <span class="font-bold text-indigo-600">
                                                    {{ $equipo->participantes->count() }}/{{ $evento->max_miembros }}
                                                </span>
                                            </div>
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">Estado:</span>
                                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                                             {{ $equipo->estado === 'aprobado' ? 'bg-emerald-100 text-emerald-700' :
                                                                ($equipo->estado === 'pendiente' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                                                    {{ ucfirst($equipo->estado) }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="flex gap-2 pt-4 border-t border-gray-200">
                                            <a href="{{ route('equipos.show', $equipo) }}" target="_blank"
                                               class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg text-center transition">
                                                Ver Equipo
                                            </a>

                                            <form method="POST" action="{{ route('equipos.destroy', $equipo) }}"
                                                  onsubmit="return confirm('¿Eliminar equipo {{ $equipo->nombre_equipo }}? No se puede deshacer.')"
                                                  class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-sm rounded-lg transition">
                                                    🗑️ Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="text-gray-600 font-bold text-lg">Aún no hay equipos inscritos</p>
                                <p class="text-gray-500 text-sm mt-2">Los equipos aparecerán aquí cuando se inscriban al evento</p>
                            </div>
                        @endif
                    </div>

<div class="pt-10 border-t-2 border-purple-100 flex flex-col sm:flex-row gap-5">
    <button type="submit"
            class="flex-1 px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600
                   hover:from-indigo-700 hover:to-purple-700
                   text-white font-bold text-lg rounded-2xl
                   shadow-xl hover:shadow-purple-500/40
                   transform hover:-translate-y-1
                   transition-all duration-300
                   flex items-center justify-center gap-3 group">
        Guardar cambios
        <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
        </svg>
    </button>

    <a href="{{ route('admin.eventos.show', $evento) }}"
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
</div>
@endsection
