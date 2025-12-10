@extends('layouts.master')

@section('title', 'Gestión de Eventos')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-16">
            <div>
                <h1 class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-4">
                    Gestión de Eventos
                </h1>
                <p class="text-2xl text-gray-700 font-medium">
                    Administra todos los hackathons, concursos y competiciones
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-4 px-8 py-5 bg-white/90 backdrop-blur-xl text-indigo-600 font-black text-xl rounded-3xl hover:bg-indigo-50 transition transform hover:-translate-x-2 shadow-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Panel
            </a>

            <a href="{{ route('eventos.create') }}"
               class="inline-flex items-center gap-4 px-10 py-6 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-black text-2xl rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-300 group">
                <svg class="w-10 h-10 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Nuevo Evento
            </a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Total eventos</p>
                        <p class="text-5xl font-black text-indigo-600 mt-3">{{ $eventos->total() }}</p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Inscripción abierta</p>
                        <p class="text-5xl font-black text-emerald-600 mt-3">
                            {{ $eventos->where('estado', 'inscripcion')->count() }}
                        </p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">En curso</p>
                        <p class="text-5xl font-black text-amber-600 mt-3">
                            {{ $eventos->where('estado', 'en_curso')->count() }}
                        </p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Finalizados</p>
                        <p class="text-5xl font-black text-gray-600 mt-3">
                            {{ $eventos->where('estado', 'finalizado')->count() }}
                        </p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-gray-500 to-gray-700 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <div class="bg-white/90 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
                            <th class="px-8 py-6 text-left font-black text-lg">Evento</th>
                            <th class="px-8 py-6 text-left font-black text-lg">Fechas</th>
                            <th class="px-8 py-6 text-left font-black text-lg">Estado</th>
                            <th class="px-8 py-6 text-center font-black text-lg">Equipos</th>
                            <th class="px-8 py-6 text-center font-black text-lg">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($eventos as $evento)
                            <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-6">
                                        @if($evento->banner)
                                            <img src="{{
                                                    $evento->banner
                                                        ? (filter_var($evento->banner, FILTER_VALIDATE_URL)
                                                            ? $evento->banner
                                                            : Storage::url($evento->banner))
                                                        : asset('images/event-placeholder.jpg')
                                                }}"
                                                    alt="{{ $evento->nombre }}"
                                                    class="w-20 h-20 rounded-2xl object-cover ring-4 ring-purple-100 shadow-lg">
                                        @else
                                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center text-white font-black text-3xl shadow-lg">
                                                {{ Str::upper(substr($evento->nombre, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-2xl font-black text-gray-900">{{ $evento->nombre }}</h3>
                                            <p class="text-gray-600 font-medium">
                                                Máx. {{ $evento->max_miembros ?? 'Sin límite' }} miembros por equipo
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="space-y-2">
                                        <p class="font-bold text-gray-900">
                                            {{ $evento->fecha_inicio->format('d/m/Y') }}
                                            <span class="text-gray-500">→</span>
                                            {{ $evento->fecha_fin->format('d/m/Y') }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            {{ $evento->fecha_inicio->diffForHumans() }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    @switch($evento->estado)
                                        @case('inscripcion')
                                            <span class="px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-black rounded-full shadow-lg">
                                                Inscripción abierta
                                            </span>
                                            @break
                                        @case('en_curso')
                                            <span class="px-5 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-black rounded-full shadow-lg">
                                                En curso
                                            </span>
                                            @break
                                        @case('finalizado')
                                            <span class="px-5 py-3 bg-gradient-to-r from-gray-500 to-gray-700 text-white font-black rounded-full shadow-lg">
                                                Finalizado
                                            </span>
                                            @break
                                    @endswitch
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <span class="inline-block px-6 py-4 bg-gradient-to-br from-purple-500 to-pink-600 text-white font-black text-3xl rounded-2xl shadow-xl">
                                        {{ $evento->equipos_count ?? 0 }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('admin.eventos.show', $evento) }}"
                                           class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-2xl shadow-lg transform hover:scale-105 transition">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.eventos.edit', $evento) }}"
                                           class="px-6 py-4 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold rounded-2xl shadow-lg transform hover:scale-105 transition">
                                            Editar
                                        </a>
                                        <button type="button"
                                                onclick="confirm('¿Eliminar este evento y todos sus equipos?') && document.getElementById('delete-{{ $evento->id }}').submit()"
                                                class="px-6 py-4 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold rounded-2xl shadow-lg transform hover:scale-105 transition">
                                            Eliminar
                                        </button>

                                        <form id="delete-{{ $evento->id }}"
                                              action="{{ route('admin.eventos.destroy', $evento) }}"
                                              method="POST" class="hidden">
                                            @csrf @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-24 text-center">
                                    <div class="text-gray-500">
                                        <svg class="w-24 h-24 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-2xl font-bold">No hay eventos registrados</p>
                                        <p class="mt-3">¡Crea el primero ahora!</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-8 py-6 border-t border-gray-200 bg-white/50 backdrop-blur">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                    <p class="text-gray-700 font-medium">
                        Mostrando <span class="font-black text-purple-600">{{ $eventos->firstItem() }}</span>
                        al <span class="font-black text-purple-600">{{ $eventos->lastItem() }}</span>
                        de <span class="font-black text-indigo-600">{{ $eventos->total() }}</span> eventos
                    </p>
                    <div>
                        {{ $eventos->links() }}
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
