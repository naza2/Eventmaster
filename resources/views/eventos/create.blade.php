@extends('layouts.master')

@section('title', 'Crear evento')

@section('content')
<section class="py-16">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-xl p-8">
            <h2 class="text-3xl font-black mb-4">Crear nuevo evento</h2>
            <p class="text-gray-600 mb-6">Completa el formulario para publicar un nuevo evento.</p>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required
                               class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="5" class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                   class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha de fin</label>
                            <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                                   class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Máximo de miembros por equipo</label>
                            <input type="number" name="max_miembros" value="{{ old('max_miembros') }}"
                                   class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado</label>
                            <select name="estado" required class="mt-1 block w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                                <option value="inscripcion" {{ old('estado') == 'inscripcion' ? 'selected' : '' }}>Inscripción abierta</option>
                                <option value="en_curso" {{ old('estado') == 'en_curso' ? 'selected' : '' }}>En curso</option>
                                <option value="finalizado" {{ old('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Banner (imagen)</label>
                        <input type="file" name="banner" accept="image/*" class="mt-2 block w-full text-sm text-gray-600">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:shadow-2xl transition">Crear evento</button>
                        <a href="{{ route('eventos.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
