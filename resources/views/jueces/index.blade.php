@extends('layouts.app')

@section('title', 'Jueces del evento - ' . $evento->nombre)

@section('content')
<!-- HERO GESTIÓN DE JUECES -->
<section class="relative bg-gradient-to-br from-orange-600 via-red-700 to-rose-800 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Jurado Oficial
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Gestiona los jueces del evento <strong class="text-yellow-300">{{ $evento->nombre }}</strong>
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="text-xl font-bold">
                {{ $evento->jueces->count() }} juez{{ $evento->jueces->count() !== 1 ? 'es' : '' }} asignado{{ $evento->jueces->count() !== 1 ? 's' : '' }}
            </span>
        </div>
    </div>
</section>

<!-- PANEL DE GESTIÓN -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-orange-600 to-red-700 p-10 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-4xl font-black mb-4">Jueces del evento</h2>
                        <p class="text-xl opacity-90">
                            Solo los usuarios con rol <strong>Juez</strong> o <strong>Admin</strong> pueden calificar
                        </p>
                    </div>
                    @can('create', \App\Models\Juez::class)
                        <button @click="open = true"
                                class="px-8 py-4 bg-white bg-white/20 backdrop-blur border-2 border-white/30 rounded-2xl font-bold hover:bg-white/30 transition shadow-xl">
                            + Agregar juez
                        </button>
                    @endcan
                </div>
            </div>

            <div class="p-10 lg:p-16">
                @if($evento->jueces->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        @foreach($evento->jueces as $juez)
                            <div class="bg-gradient-to-br from-white to-orange-50 rounded-3xl p-10 shadow-xl hover:shadow-2xl transform hover:-translate-y-3 transition-all duration-500 border border-orange-100">
                                <div class="text-center mb-8">
                                    <img src="{{ $juez->user->foto_perfil 
                                        ? Storage::url($juez->user->foto_perfil) 
                                        : asset('images/avatar-docente.png') }}"
                                         alt="{{ $juez->user->name }}"
                                         class="w-32 h-32 mx-auto rounded-full object-cover ring-8 ring-white shadow-2xl">

                                    <h3 class="text-3xl font-black text-gray-900 mt-6">
                                        {{ $juez->user->name }}
                                    </h3>
                                    <p class="text-xl text-orange-600 font-bold mt-2">
                                        Juez oficial
                                    </p>
                                </div>

                                <div class="space-y-5 text-center">
                                    <div>
                                        <p class="text-sm text-gray-600 font-bold uppercase">Carrera</p>
                                        <p class="text-lg font-bold text-indigo-600">
                                            {{ $juez->user->carrera?->nombre ?? 'Sin especificar' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-bold uppercase">Email</p>
                                        <p class="text-lg text-gray-800">{{ $juez->user->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-bold uppercase">Estado</p>
                                        <span class="inline-block px-6 py-3 rounded-full font-bold text-lg
                                            @if($juez->activo) bg-green-100 text-green-700
                                            @else bg-red-100 text-red-700 @endif">
                                            {{ $juez->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </div>
                                </div>

                                @can('delete', $juez)
                                    <div class="mt-10 pt-8 pt-8 border-t border-gray-200">
                                        <form action="{{ route('jueces.destroy', [$evento, $juez]) }}" method="POST" class="text-center">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('¿Quitar a este juez del evento?')"
                                                    class="text-red-600 hover:text-red-800 font-bold text-lg transition">
                                                Quitar del jurado
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-32">
                        <div class="w-40 h-40 bg-gradient-to-br from-orange-100 to-red-100 rounded-full mx-auto mb-10 flex items-center justify-center">
                            <svg class="w-20 h-20 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1h12v-1zm0 0h6v-1h-6v-1zm0 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-4xl font-black text-gray-900 mb-6">
                            Aún no hay jueces asignados
                        </h3>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                            Agrega profesores o expertos para que puedan calificar los proyectos
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- MODAL PARA AGREGAR JUEZ (Alpine.js) -->
        <div x-data="{ open: false }" x-show="open && document.body.classList.add('overflow-hidden') || document.body.classList.remove('overflow-hidden')">
            <div x-show="open" class="fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-6" @keydown.escape.window="open = false">
                <div @click.away="open = false" class="bg-white rounded-3xl shadow-3xl max-w-2xl w-full p-10">
                    <h3 class="text-4xl font-black text-gray-900 mb-8">Agregar nuevo juez</h3>

                    <form action="{{ route('juez.store', $evento) }}" method="POST">
                        @csrf

                        <div class="mb-10">
                            <label for="user_id" class="block text-xl font-bold text-gray-800 mb-4">
                                Buscar profesor por nombre, email o matrícula
                            </label>
                            <input type="text" name="user_id" id="user_id" required
                                   class="w-full px-8 py-5 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                   placeholder="Ej: Juan Pérez, juan@universidad.edu.mx, 2019001234">
                        </div>

                        <div class="flex gap-6 justify-center">
                            <button type="button" @click="open = false"
                                    class="px-10 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition">
                                Cancelar
                            </button>
                            <button type="submit"
                                    class="px-12 py-5 bg-gradient-to-r from-orange-600 to-red-700 text-white font-black text-xl rounded-2xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                                Agregar al jurado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection