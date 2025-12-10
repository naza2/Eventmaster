{{-- resources/views/equipos/invitar.blade.php --}}
<x-app-layout :title="'Invitar - ' . $equipo->nombre_equipo">

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header compacto -->
            <div class="mb-8">
                <a href="{{ route('equipos.show', $equipo) }}"
                   class="inline-flex items-center text-purple-600 hover:text-purple-800 font-medium text-sm mb-4 transition">
                    <svg class="w-5 h- mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver
                </a>

                <h1 class="text-3xl font-black text-gray-900">Invitar participantes</h1>
                <p class="text-sm text-gray-600 mt-1">
                    {{ $equipo->nombre_equipo }} • 
                    <span class="font-medium">{{ $equipo->participantes->count() }}/{{ $equipo->evento->max_miembros }} miembros</span>
                </p>
            </div>

            <!-- Mensajes -->
            @if (session('success'))
                <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 font-medium text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 font-medium text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Buscador compacto -->
            <div class="bg-white rounded-2xl shadow-lg p-5 mb-6">
                <form method="GET" class="flex gap-3">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nombre, email, matrícula o carrera..."
                           class="flex-1 px-5 py-3 border border-gray-300 rounded-xl focus:border-purple-500 focus:outline-none focus:ring-2 focus:ring-purple-100 text-sm">

                    <button type="submit"
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl text-sm transition">
                        Buscar
                    </button>

                    @if(request('search'))
                        <a href="{{ route('equipos.invitar', $equipo) }}"
                           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl text-sm transition">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <!-- Lista compacta -->
            @if($usuarios->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <p class="text-lg font-bold text-gray-800">No hay alumnos disponibles</p>
                    <p class="text-sm text-gray-500 mt-2">Todos ya están en un equipo o no coinciden con la búsqueda.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($usuarios as $usuario)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100">
                            <div class="p-5 flex items-center justify-between gap-6">
                                <!-- Foto + Info -->
                                <div class="flex items-center gap-5 flex-1">
                                    <img src="{{ 
                                        $usuario->foto_perfil 
                                            ? (filter_var($usuario->foto_perfil, FILTER_VALIDATE_URL) 
                                                ? $usuario->foto_perfil 
                                                : Storage::url($usuario->foto_perfil))
                                            : asset('images/avatar.svg')
                                    }}"
                                         alt="{{ $usuario->name }}"
                                         class="w-14 h-14 rounded-full object-cover ring-4 ring-purple-50">

                                    <div>
                                        <h3 class="font-black text-gray-900 text-lg">{{ $usuario->name }}</h3>
                                        <div class="text-sm text-gray-600 space-y-1 mt-1">
                                            <p>{{ $usuario->email }}</p>
                                            <p class="font-medium text-purple-600">{{ $usuario->carrera?->nombre ?? 'Sin carrera' }}</p>
                                            <p class="text-gray-500">Matrícula: <span class="font-bold">{{ $usuario->matricula ?? '—' }}</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botón invitar -->
                                <form method="POST" action="{{ route('invitaciones.enviar', $equipo) }}">
                                    @csrf
                                    <input type="hidden" name="invitado_id" value="{{ $usuario->id }}">
                                    <button type="submit"
                                            class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 text-sm">
                                        Invitar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación pequeña -->
                <div class="mt-8">
                    {{ $usuarios->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>