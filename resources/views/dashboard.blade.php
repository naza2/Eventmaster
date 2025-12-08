{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 py-12">
        <div class="max-w-7xl mx-auto px-6">

            @if(auth()->user()->hasRole('administrador'))

                {{-- PANEL ADMINISTRATIVO – NIVEL DIOS --}}
                <div class="text-center mb-16">
                    <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-700 mb-4">
                        Panel de Administración
                    </h1>
                    <p class="text-2xl text-gray-700">Control total sobre usuarios, eventos y plataforma</p>
                </div>

                <!-- Estadísticas rápidas -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Usuarios totales</p>
                                <p class="text-5xl font-black text-indigo-600 mt-2">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Eventos activos</p>
                                <p class="text-5xl font-black text-purple-600 mt-2">{{ \App\Models\Evento::whereIn('estado', ['inscripcion', 'en_curso'])->count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Equipos formados</p>
                                <p class="text-5xl font-black text-emerald-600 mt-2">{{ \App\Models\Equipo::count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-8 border border-white/20">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm">Inscripciones hoy</p>
                                <p class="text-5xl font-black text-rose-600 mt-2">{{ \App\Models\Participante::whereDate('created_at', today())->count() }}</p>
                            </div>
                            <div class="w-16 h-16 bg-rose-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-9 h-9 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accesos rápidos Admin -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                    <a href="{{ route('admin.usuarios.index') }}"
                       class="group relative overflow-hidden rounded-3xl shadow-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-10 hover:shadow-indigo-500/50 transition-all transform hover:-translate-y-3">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition"></div>
                        <div class="relative z-10">
                            <h3 class="text-4xl font-black mb-4">Gestión de Usuarios</h3>
                            <p class="text-xl opacity-90 mb-8">Ver, editar, suspender o eliminar cuentas</p>
                            <span class="inline-flex items-center gap-3 text-2xl font-bold group-hover:gap-6 transition-all">
                                Ir al panel
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </div>
                    </a>

                    <a href="{{ route('admin.eventos.index') }}"
                       class="group relative overflow-hidden rounded-3xl shadow-2xl bg-gradient-to-br from-purple-500 to-pink-600 text-white p-10 hover:shadow-purple-500/50 transition-all transform hover:-translate-y-3">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/30 transition"></div>
                        <div class="relative z-10">
                            <h3 class="text-4xl font-black mb-4">Gestión de Eventos</h3>
                            <p class="text-xl opacity-90 mb-8">Crear, editar y controlar todos los eventos</p>
                            <span class="inline-flex items-center gap-3 text-2xl font-bold group-hover:gap-6 transition-all">
                                Ir al panel
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                </div>


            @else

                {{-- DASHBOARD ESTUDIANTE – ELEGANTE Y MOTIVADOR --}}
                <div class="text-center mb-16">
                    <h1 class="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 mb-6">
                        ¡Bienvenido, {{ auth()->user()->name }}!
                    </h1>
                    <p class="text-2xl text-gray-700">Listo para ganar tu próximo hackathon?</p>
                </div>

                <!-- Estadísticas del estudiante -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/30 text-center">
                        <div class="text-6xl font-black text-purple-600 mb-4">
                            {{ \App\Models\Evento::where('estado', 'inscripcion')->count() }}
                        </div>
                        <p class="text-xl font-bold text-gray-800">Eventos en inscripción</p>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/30 text-center">
                        <div class="text-6xl font-black text-emerald-600 mb-4">
                            {{ auth()->user()->participantes()->count() }}
                        </div>
                        <p class="text-xl font-bold text-gray-800">Mis equipos activos</p>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-10 border border-white/30 text-center">
                        <div class="text-6xl font-black text-amber-600 mb-4">
                            {{ auth()->user()->participantes()->whereHas('equipo.evento', fn($q) => $q->where('estado', 'finalizado'))->count() }}
                        </div>
                        <p class="text-xl font-bold text-gray-800">Eventos completados</p>
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <a href="{{ route('eventos.index') }}"
                       class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-500/10 to-purple-500/10 p-1 hover:shadow-2xl transition-all">
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-10 h-full group-hover:bg-white transition">
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-xl">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-black text-gray-900 mb-2">Explorar Eventos</h3>
                                    <p class="text-gray-600">Encuentra el próximo hackathon, olimpiada o concurso</p>
                                </div>
                            </div>
                            <div class="mt-8 text-right">
                                <span class="text-indigo-600 font-bold text-xl group-hover:text-2xl transition-all">
                                    Ir ahora
                                </span>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('equipos.index') }}"
                       class="group relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-500/10 to-teal-500/10 p-1 hover:shadow-2xl transition-all">
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-10 h-full group-hover:bg-white transition">
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center shadow-xl">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-black text-gray-900 mb-2">Mis Equipos</h3>
                                    <p class="text-gray-600">Gestiona tus proyectos y compañeros</p>
                                </div>
                            </div>
                            <div class="mt-8 text-right">
                                <span class="text-emerald-600 font-bold text-xl group-hover:text-2xl transition-all">
                                    Ir ahora
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>
