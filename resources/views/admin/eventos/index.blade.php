@extends('layouts.master')

@section('title', 'Gestión de Eventos')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-4xl font-black text-gray-900">Gestión de Eventos</h1>
            <a href="{{ route('eventos.create') }}" class="px-6 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700">
                + Crear Evento
            </a>
        </div>

        <!-- Información de paginación -->
        <div class="mb-6 flex items-center justify-between bg-purple-50 rounded-2xl p-6">
            <div>
                <p class="text-sm text-purple-600 font-bold">Total de Eventos</p>
                <p class="text-3xl font-black text-purple-700">{{ $eventos->total() }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-purple-600 font-bold">Página {{ $eventos->currentPage() }} de {{ $eventos->lastPage() }}</p>
                <p class="text-lg text-purple-700 font-bold">Mostrando {{ $eventos->count() }} de {{ $eventos->total() }}</p>
            </div>
        </div>

        <!-- Tabla de eventos -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold">Evento</th>
                            <th class="px-6 py-4 text-left font-bold">Fecha Inicio</th>
                            <th class="px-6 py-4 text-left font-bold">Fecha Fin</th>
                            <th class="px-6 py-4 text-left font-bold">Estado</th>
                            <th class="px-6 py-4 text-center font-bold">Equipos</th>
                            <th class="px-6 py-4 text-center font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($eventos as $evento)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if($evento->banner)
                                            <img src="{{ Storage::url($evento->banner) }}" alt="{{ $evento->nombre }}" class="w-16 h-16 rounded-lg object-cover">
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold">
                                                {{ Str::upper(substr($evento->nombre, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-gray-900 max-w-xs">{{ $evento->nombre }}</p>
                                            <p class="text-sm text-gray-600">Max. {{ $evento->max_miembros }} miembros/equipo</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $evento->fecha_inicio->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $evento->fecha_fin->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    @switch($evento->estado)
                                        @case('inscripcion')
                                            <span class="px-3 py-1 bg-green-100 text-green-700 font-bold rounded-full text-sm">Inscripción abierta</span>
                                            @break
                                        @case('en_curso')
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 font-bold rounded-full text-sm">En curso</span>
                                            @break
                                        @case('finalizado')
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 font-bold rounded-full text-sm">Finalizado</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 font-bold rounded-full">
                                        {{ $evento->equipos_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.eventos.show', $evento) }}" 
                                           class="px-4 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition text-sm">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.eventos.edit', $evento) }}" 
                                           class="px-4 py-2 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600 transition text-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" class="inline"
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition text-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-600">
                                    No hay eventos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $eventos->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
