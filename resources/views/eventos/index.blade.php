<<<<<<< HEAD
{{-- resources/views/eventos/index.blade.php --}}
=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
@extends('layouts.master')

@section('title', 'Eventos')

@section('content')
<<<<<<< HEAD
<!-- HERO ÉPICO -->
<section class="relative overflow-hidden py-40">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 opacity-95"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>

            <div class="relative max-w-7xl mx-auto px-6 text-center text-white">
                <h1 class="text-7xl md:text-9xl font-black mb-8 tracking-tight drop-shadow-2xl">
                    Eventos
                </h1>
                <p class="text-3xl md:text-4xl font-light max-w-5xl mx-auto opacity-95 leading-relaxed">
                    Hackathons, concursos, ferias de proyectos y todo lo que mueve la innovación
                </p>
            </div>
        </div>
    </div>
</section>
<livewire:eventos-search />
=======
<!-- HERO EVENTOS -->
<section class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white py-24">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Todos los Eventos
        </h1>
        <p class="text-xl md:text-2xl font-light max-w-4xl mx-auto opacity-90">
            Descubre hackathons, concursos, ferias de proyectos y mucho más en tu universidad
        </p>

        <!-- Filtros rápidos -->
        <div class="mt-12 flex flex-wrap justify-center gap-4">
            <a href="{{ route('eventos.index') }}"
               class="px-8 py-4 bg-white/20 backdrop-blur border-2 border-white/30 rounded-full font-bold hover:bg-white/30 transition">
                Todos
            </a>
            <a href="{{ route('eventos.index') }}?estado=inscripcion"
               class="px-8 py-4 bg-green-500/30 border-2 border-green-300 rounded-full font-bold hover:bg-green-500/50 transition">
                Inscripción abierta
            </a>
            <a href="{{ route('eventos.index') }}?estado=en_curso"
               class="px-8 py-4 bg-yellow-500/30 border-2 border-yellow-300 rounded-full font-bold hover:bg-yellow-500/50 transition">
                En curso
            </a>
            <a href="{{ route('eventos.index') }}?estado=finalizado"
               class="px-8 py-4 bg-gray-600/50 border-2 border-gray-400 rounded-full font-bold hover:bg-gray-600/70 transition">
                Finalizados
            </a>
        </div>
    </div>
</section>

<!-- LISTA DE EVENTOS -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl font-black text-gray-900">
                    {{ $eventos->total() }} evento{{ $eventos->total() !== 1 ? 's' : '' }} encontrado{{ $eventos->total() !== 1 ? 's' : '' }}
                </h2>
                <p class="text-lg text-gray-600 mt-2">
                    Actualizado al {{ now()->format('d/m/Y') }}
                </p>
            </div>

            <!-- Buscador -->
            <form action="{{ route('eventos.index') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Buscar evento..."
                       class="pl-12 pr-6 py-4 w-96 rounded-2xl border border-gray-300 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </form>
        </div>

        @if($eventos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($eventos as $evento)
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transform hover:-translate-y-4 transition-all duration-500 border border-gray-100">
                        <!-- Banner -->
                        <div class="relative h-64 bg-cover bg-center group" style="background-image: url('{{ $evento->banner ? Storage::url($evento->banner) : asset('images/event-default.jpg') }}')">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
                            
                            <!-- Estado del evento -->
                            <div class="absolute top-6 left-6">
                                @switch($evento->estado)
                                    @case('inscripcion')
                                        <span class="px-5 py-3 bg-green-500 text-white font-bold rounded-full shadow-lg">Inscripción abierta</span>
                                        @break
                                    @case('en_curso')
                                        <span class="px-5 py-3 bg-yellow-500 text-white font-bold rounded-full shadow-lg">En curso</span>
                                        @break
                                    @case('finalizado')
                                        <span class="px-5 py-3 bg-gray-600 text-white font-bold rounded-full shadow-lg">Finalizado</span>
                                        @break
                                @endswitch
                            </div>

                            <!-- Equipos inscritos -->
                            <div class="absolute bottom-6 right-6 bg-black/60 backdrop-blur px-5 py-3 rounded-2xl">
                                <p class="text-white font-bold text-2xl">{{ $evento->equipos_count ?? 0 }}</p>
                                <p class="text-white/80 text-sm">Equipos</p>
                            </div>
                        </div>

                        <!-- Contenido -->
                        <div class="p-8">
                            <h3 class="text-2xl font-black text-gray-900 mb-4 line-clamp-2">
                                {{ $evento->nombre }}
                            </h3>

                            <p class="text-gray-600 mb-6 line-clamp-3">
                                {{ $evento->descripcion ?? 'Sin descripción disponible' }}
                            </p>

                            <!-- Fechas -->
                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <div class="bg-indigo-50 rounded-2xl p-4 text-center">
                                    <p class="text-sm text-indigo-600 font-bold">Inicio</p>
                                    <p class="text-xl font-black text-indigo-700">
                                        {{ $evento->fecha_inicio->format('d/m') }}
                                    </p>
                                </div>
                                <div class="bg-purple-50 rounded-2xl p-4 text-center">
                                    <p class="text-sm text-purple-600 font-bold">Fin</p>
                                    <p class="text-xl font-black text-purple-700">
                                        {{ $evento->fecha_fin->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Botón -->
                            <div class="text-center">
                                <a href="{{ route('eventos.show', $evento) }}"
                                   class="inline-block w-full px-8 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-lg rounded-2xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                                    Ver evento completo
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Paginación bonita -->
            <div class="mt-16 flex justify-center">
                {{ $eventos->links() }}
            </div>
        @else
            <div class="text-center py-32">
                <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-8 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2a2 2 0 01-2-2V9a2 2 0 012-2h2m-8 6h.01"/>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4">No hay eventos disponibles</h3>
                <p class="text-xl text-gray-600">Pronto anunciaremos nuevos concursos y hackathons</p>
            </div>
        @endif
    </div>
</section>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
@endsection