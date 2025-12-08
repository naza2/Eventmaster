{{-- resources/views/livewire/eventos-search.blade.php --}}
<div>
    <!-- Filtros + buscador (más compacto y elegante) -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8 mb-16">
        <div class="flex flex-wrap justify-center gap-5">
            @php $estadoActual = $estado; @endphp

            <!-- Botones de filtro -->
            @foreach([
                '' => ['label' => 'Todos', 'color' => 'white'],
                'inscripcion' => ['label' => 'Inscripción abierta', 'color' => 'emerald'],
                'en_curso' => ['label' => 'En curso', 'color' => 'amber'],
                'finalizado' => ['label' => 'Finalizados', 'color' => 'gray']
            ] as $key => $filter)
                <button wire:click="$set('estado', '{{ $key }}')"
                        class="px-10 py-5 rounded-full font-black text-xl shadow-xl transition-all duration-300
                               {{ $estadoActual === $key 
                                    ? "bg-{$filter['color']}-500 text-white border-4 border-{$filter['color']}-300 shadow-{$filter['color']}-500/50" 
                                    : "bg-{$filter['color']}-500/40 backdrop-blur-xl border-4 border-{$filter['color']}-300 hover:bg-{$filter['color']}-500/60" }}">
                    {{ $filter['label'] }}
                </button>
            @endforeach
        </div>

        <!-- Buscador premium -->
        <div class="relative max-w-lg w-full">
            <input type="text"
                   wire:model.live.debounce.400ms="search"
                   placeholder="Buscar evento..."
                   class="w-full pl-16 pr-14 py-6 text-xl rounded-3xl border-2 border-gray-200 
                          focus:border-purple-600 focus:ring-8 focus:ring-purple-100 
                          shadow-2xl transition-all duration-300 bg-white/90 backdrop-blur-xl">

            <!-- Lupa -->
            <svg class="absolute left-6 top-1/2 -translate-y-1/2 w-9 h-9 text-gray-400 pointer-events-none"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" 
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>

            <!-- Limpiar -->
            @if($search)
                <button wire:click="$set('search', '')"
                        class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 transition">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            @endif
        </div>
    </div>

    @if($eventos->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        @foreach($eventos as $evento)
            <a href="{{ route('eventos.show', $evento) }}"
               class="group block bg-white/95 backdrop-blur-xl rounded-3xl shadow-xl overflow-hidden 
                      hover:shadow-2xl hover:shadow-purple-600/20 
                      transform hover:-translate-y-4 transition-all duration-500 
                      border border-white/30">

                <!-- Banner más pequeño -->
                <div class="relative h-56 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                    @if($evento->banner)
                        <img src="{{ filter_var($evento->banner, FILTER_VALIDATE_URL) ? $evento->banner : Storage::url($evento->banner) }}"
                             alt="{{ $evento->nombre }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></div>
                    @endif

                    <!-- Estado más pequeño -->
                    <div class="absolute top-4 left-4 z-20">
                        @switch($evento->estado)
                            @case('inscripcion')
                                <span class="px-5 py-2 bg-emerald-500 text-white font-bold text-sm rounded-full shadow-lg">
                                    Inscripción
                                </span>
                                @break
                            @case('en_curso')
                                <span class="px-5 py-2 bg-amber-500 text-white font-bold text-sm rounded-full shadow-lg">
                                    En curso
                                </span>
                                @break
                            @case('finalizado')
                                <span class="px-5 py-2 bg-gray-600 text-white font-bold text-sm rounded-full shadow-lg">
                                    Finalizado
                                </span>
                                @break
                        @endswitch
                    </div>

                    <!-- Contador de equipos más pequeño -->
                    <div class="absolute bottom-4 right-4 z-20">
                        <div class="bg-white/25 backdrop-blur px-4 py-2 rounded-xl shadow-xl border border-white/40 text-center">
                            <p class="text-white text-2xl font-black leading-none">
                                {{ $evento->equipos_count ?? 0 }}
                            </p>
                            <p class="text-white/90 text-xs font-bold">equipos</p>
                        </div>

                    </div>

                    <!-- Nombre del evento más pequeño -->
                    <div class="absolute bottom-4 left-4 right-20 z-20">
                        <h3 class="text-2xl md:text-3xl font-black text-white drop-shadow-xl leading-tight line-clamp-2">
                            {{ $evento->nombre }}
                        </h3>
                    </div>
                </div>

                <!-- Contenido inferior más compacto -->
                <div class="p-6 bg-white">
                    <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-2">
                        {{ $evento->descripcion ?? 'Sin descripción disponible' }}
                    </p>

                    <!-- Fechas más pequeñas -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-indigo-50 rounded-2xl p-4 text-center">
                            <p class="text-indigo-600 font-bold text-xs mb-1">INICIO</p>
                            <p class="text-2xl font-black text-indigo-700">
                                {{ $evento->fecha_inicio->format('d') }}
                            </p>
                            <p class="text-xs text-indigo-600 font-medium">
                                {{ $evento->fecha_inicio->translatedFormat('M') }}
                            </p>
                        </div>
                        <div class="bg-purple-50 rounded-2xl p-4 text-center">
                            <p class="text-purple-600 font-bold text-xs mb-1">FIN</p>
                            <p class="text-2xl font-black text-purple-700">
                                {{ $evento->fecha_fin->format('d') }}
                            </p>
                            <p class="text-xs text-purple-600 font-medium">
                                {{ $evento->fecha_fin->translatedFormat('M Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- CTA más pequeño -->
                    <div class="text-center">
                        <span class="inline-block w-full px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 
                                     hover:from-indigo-700 hover:to-purple-700 
                                     text-white font-bold text-base rounded-2xl 
                                     shadow-lg hover:shadow-purple-500/50 
                                     transform hover:scale-105 transition-all duration-300">
                            Ver evento
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-16 flex justify-center">
        {{ $eventos->links() }}
    </div>
@else
    <!-- Sin resultados -->
    <div class="text-center py-32 bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30">
        <p class="text-4xl font-black text-gray-600">No se encontraron eventos</p>
    </div>
@endif
</div>