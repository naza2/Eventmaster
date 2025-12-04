@extends('layouts.master')

@section('title', 'Editar Evento')

@section('content')
<section class="py-16">
    <div class="max-w-3xl mx-auto px-6">
        <div class="mb-8">
            <a href="{{ route('admin.eventos.show', $evento) }}" class="text-indigo-600 hover:text-indigo-700 font-bold">
                ← Volver al evento
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-10">
            <h1 class="text-3xl font-black text-gray-900 mb-8">Editar: {{ $evento->nombre }}</h1>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.eventos.update', $evento) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')
                <input type="hidden" name="tab" value="{{ request()->query('tab') }}">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $evento->nombre) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Descripción</label>
                    <textarea name="descripcion" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">{{ old('descripcion', $evento->descripcion) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Inicio</label>
                        <input type="datetime-local" name="fecha_inicio" value="{{ old('fecha_inicio', $evento->fecha_inicio->format('Y-m-d\TH:i')) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Fin</label>
                        <input type="datetime-local" name="fecha_fin" value="{{ old('fecha_fin', $evento->fecha_fin->format('Y-m-d\TH:i')) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Máximo de miembros por equipo</label>
                        <input type="number" name="max_miembros" value="{{ old('max_miembros', $evento->max_miembros) }}" min="1"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Estado</label>
                        <select name="estado" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                            <option value="inscripcion" {{ old('estado', $evento->estado) === 'inscripcion' ? 'selected' : '' }}>Inscripción abierta</option>
                            <option value="en_curso" {{ old('estado', $evento->estado) === 'en_curso' ? 'selected' : '' }}>En curso</option>
                            <option value="finalizado" {{ old('estado', $evento->estado) === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Banner (imagen)</label>
                    @if($evento->banner)
                        <div class="mb-4">
                            <img src="{{ Storage::url($evento->banner) }}" alt="{{ $evento->nombre }}" class="max-h-48 rounded-xl">
                            <p class="text-sm text-gray-600 mt-2">Banner actual</p>
                        </div>
                    @endif
                    <input type="file" name="banner" accept="image/*" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl">
                </div>

                <div class="pt-6 border-t border-gray-200 flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                        Guardar cambios
                    </button>
                    <a href="{{ route('admin.eventos.show', $evento) }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
