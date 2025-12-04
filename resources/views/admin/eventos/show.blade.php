@extends('layouts.master')

@section('title', $evento->nombre)

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Encabezado con banner -->
        <div class="relative h-64 rounded-3xl overflow-hidden mb-8 shadow-xl">
            @if($evento->banner)
                <img src="{{ Storage::url($evento->banner) }}" alt="{{ $evento->nombre }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end pointer-events-none">
                <div class="w-full px-8 pb-8 text-white">
                    <h1 class="text-5xl font-black mb-4">{{ $evento->nombre }}</h1>
                    <div class="flex gap-6">
                        <div>
                            <p class="text-sm opacity-80">Inicio</p>
                            <p class="text-2xl font-bold">{{ $evento->fecha_inicio->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm opacity-80">Fin</p>
                            <p class="text-2xl font-bold">{{ $evento->fecha_fin->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="mb-8 flex gap-4">
            <a href="{{ route('admin.eventos.index') }}" class="px-6 py-3 bg-gray-600 text-white font-bold rounded-xl hover:bg-gray-700">
                ← Volver
            </a>
            <a href="{{ route('admin.eventos.edit', $evento) }}{{ request()->query('tab') ? ('?tab=' . request()->query('tab')) : '' }}" class="px-6 py-3 bg-yellow-500 text-white font-bold rounded-xl hover:bg-yellow-600">
                Editar
            </a>
            <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" class="inline"
                  onsubmit="return confirm('¿Estás seguro?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600">
                    Eliminar
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información del evento -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl p-10 mb-8">
                    <h2 class="text-2xl font-black text-gray-900 mb-6">Información</h2>
                    
                    <div class="grid grid-cols-2 gap-8 mb-8">
                        <div>
                            <p class="text-sm text-gray-600 font-bold mb-2">Estado</p>
                            @switch($evento->estado)
                                @case('inscripcion')
                                    <span class="px-4 py-2 bg-green-100 text-green-700 font-bold rounded-full">Inscripción abierta</span>
                                    @break
                                @case('en_curso')
                                    <span class="px-4 py-2 bg-yellow-100 text-yellow-700 font-bold rounded-full">En curso</span>
                                    @break
                                @case('finalizado')
                                    <span class="px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-full">Finalizado</span>
                                    @break
                            @endswitch
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold mb-2">Máximo de miembros</p>
                            <p class="text-2xl font-black text-indigo-600">{{ $evento->max_miembros }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 font-bold mb-3">Descripción</p>
                        <p class="text-gray-700 leading-relaxed">{{ $evento->descripcion ?? 'Sin descripción' }}</p>
                    </div>
                </div>

                <!-- Equipos participantes -->
                <div class="bg-white rounded-3xl shadow-xl p-10">
                    <h2 class="text-2xl font-black text-gray-900 mb-6">Equipos participantes ({{ $evento->equipos->count() }})</h2>
                    
                    @if($evento->equipos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($evento->equipos as $equipo)
                                <div class="border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-xl font-black text-gray-900">{{ $equipo->nombre_equipo }}</h3>
                                            <p class="text-purple-600 font-bold">{{ $equipo->nombre_proyecto }}</p>
                                        </div>
                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full">
                                            {{ $equipo->participantes->count() }}/{{ $evento->max_miembros }}
                                        </span>
                                    </div>
                                    
                                    <div class="mb-4 pb-4 border-b border-gray-200">
                                        <p class="text-sm text-gray-600 mb-2">Líder:</p>
                                        @php
                                            $lider = $equipo->participantes->where('es_lider', true)->first();
                                        @endphp
                                        <p class="font-bold text-gray-900">{{ $lider?->user->name ?? 'Sin líder' }}</p>
                                    </div>

                                    <div>
                                        <span class="px-3 py-1 text-xs font-bold rounded-full
                                            @if($equipo->estado === 'aprobado') bg-green-100 text-green-700
                                            @elseif($equipo->estado === 'pendiente') bg-yellow-100 text-yellow-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ ucfirst($equipo->estado) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-600">
                            No hay equipos registrados aún
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="bg-white rounded-3xl shadow-xl p-8 h-fit">
                <h3 class="text-xl font-black text-gray-900 mb-6">Resumen</h3>
                
                <div class="space-y-6">
                    <div class="text-center">
                        <p class="text-4xl font-black text-indigo-600 mb-2">{{ $evento->equipos->count() }}</p>
                        <p class="text-gray-600">Equipos inscritos</p>
                    </div>

                    <div class="bg-indigo-50 rounded-2xl p-6 text-center">
                        <p class="text-sm text-indigo-600 font-bold mb-2">Total de participantes</p>
                        <p class="text-3xl font-black text-indigo-700">
                            {{ $evento->equipos->sum(fn($e) => $e->participantes->count()) }}
                        </p>
                    </div>

                    <div class="bg-purple-50 rounded-2xl p-6 text-center">
                        <p class="text-sm text-purple-600 font-bold mb-2">Jueces asignados</p>
                        <p class="text-3xl font-black text-purple-700">
                            {{ $evento->jueces->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
