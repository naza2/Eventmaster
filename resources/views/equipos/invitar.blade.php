@php
    $title = 'Invitar Miembros';
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('equipos.show', $equipo) }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver al equipo
                </a>

                <h1 class="text-4xl font-black text-gray-900 mb-3">
                    Invitar Miembros
                </h1>
                <p class="text-lg text-gray-600">
                    Equipo: <strong>{{ $equipo->nombre_equipo }}</strong>
                </p>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                    <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                    <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Búsqueda -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <form method="GET" action="{{ route('equipos.invitar', $equipo) }}" class="flex gap-4">
                    <div class="flex-1">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Buscar por nombre, email, matrícula o carrera..."
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-0 transition">
                    </div>
                    <button type="submit"
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('equipos.invitar', $equipo) }}"
                           class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            <!-- Lista de Usuarios -->
            @if ($usuarios->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-gray-900">No hay usuarios disponibles</h3>
                    <p class="mt-2 text-gray-600">
                        @if(request('search'))
                            No se encontraron usuarios con ese criterio de búsqueda.
                        @else
                            Todos los usuarios ya están en el equipo o no hay usuarios registrados.
                        @endif
                    </p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($usuarios as $usuario)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                            <div class="p-6">
                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $usuario->foto_perfil ? Storage::url($usuario->foto_perfil) : asset('images/avatar.svg') }}"
                                                 alt="{{ $usuario->name }}"
                                                 class="w-16 h-16 rounded-full object-cover border-4 border-purple-100">
                                        </div>

                                        <div class="flex-1">
                                            <h3 class="text-xl font-black text-gray-900">
                                                {{ $usuario->name }}
                                            </h3>
                                            <div class="mt-2 space-y-1">
                                                <p class="text-gray-600 flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ $usuario->email }}
                                                </p>
                                                @if($usuario->carrera)
                                                    <p class="text-purple-600 font-semibold flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                        </svg>
                                                        {{ $usuario->carrera->nombre }}
                                                    </p>
                                                @endif
                                                @if($usuario->matricula)
                                                    <p class="text-gray-500 text-sm flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                                        </svg>
                                                        No. Control: {{ $usuario->matricula }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('invitaciones.enviar', $equipo) }}">
                                        @csrf
                                        <input type="hidden" name="invitado_id" value="{{ $usuario->id }}">
                                        <button type="submit"
                                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            Invitar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-6">
                    {{ $usuarios->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
