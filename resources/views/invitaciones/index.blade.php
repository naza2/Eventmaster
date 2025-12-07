@php
    $title = 'Mis Invitaciones';
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-4xl font-black text-gray-900 mb-3">
                    Invitaciones Pendientes
                </h1>
                <p class="text-lg text-gray-600">
                    Revisa y responde a las invitaciones para unirte a equipos
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

            @if ($invitaciones->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="mt-4 text-xl font-bold text-gray-900">No tienes invitaciones pendientes</h3>
                    <p class="mt-2 text-gray-600">Cuando recibas invitaciones para unirte a equipos, aparecerán aquí.</p>
                    <a href="{{ route('eventos.index') }}"
                       class="mt-6 inline-flex px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl transition">
                        Ver Eventos
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($invitaciones as $invitacion)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-16 h-16 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="flex-1">
                                                <h3 class="text-xl font-black text-gray-900">
                                                    {{ $invitacion->equipo->nombre_equipo }}
                                                </h3>
                                                <p class="text-purple-600 font-semibold mt-1">
                                                    {{ $invitacion->equipo->evento->nombre }}
                                                </p>

                                                <div class="mt-3 space-y-2">
                                                    <div class="flex items-center gap-2 text-gray-600">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                        </svg>
                                                        <span>Invitado por: <strong>{{ $invitacion->invitante->name }}</strong></span>
                                                    </div>

                                                    @if ($invitacion->mensaje)
                                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                                            <p class="text-sm text-gray-700 italic">"{{ $invitacion->mensaje }}"</p>
                                                        </div>
                                                    @endif

                                                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <span>{{ $invitacion->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-3 md:flex-shrink-0">
                                        <form method="POST" action="{{ route('invitaciones.aceptar', $invitacion) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full md:w-auto px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg transition">
                                                Aceptar
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('invitaciones.rechazar', $invitacion) }}">
                                            @csrf
                                            <button type="submit"
                                                    class="w-full md:w-auto px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold rounded-xl transition">
                                                Rechazar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
