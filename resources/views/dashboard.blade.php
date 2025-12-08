<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            @if(auth()->user()->hasRole('administrador'))
                <!-- PANEL ADMINISTRATIVO -->
                <div class="mb-12">
                    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl shadow-2xl p-10 text-white mb-12">
                        <h1 class="text-4xl font-black mb-2">Panel Administrativo</h1>
                        <p class="text-lg opacity-90">Gestión centralizada de usuarios y eventos</p>
                    </div>

                    <!-- Tarjetas de acceso rápido -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                        <!-- Gestión de Usuarios -->
                        <a href="{{ route('admin.usuarios.index') }}" class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                            <div class="h-32 bg-gradient-to-br from-blue-500 to-blue-700"></div>
                            <div class="p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900">Gestión de Usuarios</h3>
                                        <p class="text-gray-600">Ver y administrar</p>
                                    </div>
                                </div>
                                <div class="bg-blue-50 rounded-2xl p-4">
                                    <p class="text-3xl font-black text-blue-600">{{ \App\Models\User::count() }}</p>
                                    <p class="text-sm text-blue-700">usuarios registrados</p>
                                </div>
                            </div>
                        </a>

                        <!-- Gestión de Eventos -->
                        <a href="{{ route('admin.eventos.index') }}" class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2">
                            <div class="h-32 bg-gradient-to-br from-purple-500 to-purple-700"></div>
                            <div class="p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900">Gestión de Eventos</h3>
                                        <p class="text-gray-600">Ver y crear</p>
                                    </div>
                                </div>
                                <div class="bg-purple-50 rounded-2xl p-4">
                                    <p class="text-3xl font-black text-purple-600">{{ \App\Models\Evento::count() }}</p>
                                    <p class="text-sm text-purple-700">eventos disponibles</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Botón para crear evento -->
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl shadow-xl p-10 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-3xl font-black mb-2">¿Necesitas crear un evento?</h2>
                                <p class="text-lg opacity-90">Registra un nuevo evento rápidamente desde aquí</p>
                            </div>
                            <a href="{{ route('eventos.create') }}" class="px-8 py-4 bg-white text-green-600 font-black text-lg rounded-2xl hover:shadow-2xl transition transform hover:scale-105">
                                + Crear Evento
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- DASHBOARD PARA USUARIOS NORMALES -->
                <div class="bg-white rounded-3xl shadow-xl p-12">
                    <h1 class="text-4xl font-black text-purple-600 mb-8">Bienvenido a EventMaster</h1>
                    
                    <!-- Estadísticas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                        <div class="bg-gradient-to-br from-purple-500 to-purple-700 text-white p-8 rounded-2xl shadow-lg">
                            <h4 class="text-5xl font-black mb-2">{{ \App\Models\Evento::where('estado', 'inscripcion')->count() }}</h4>
                            <p class="text-lg opacity-90">Eventos activos</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-8 rounded-2xl shadow-lg">
                            <h4 class="text-5xl font-black mb-2">{{ auth()->user()->participantes()->count() }}</h4>
                            <p class="text-lg opacity-90">Mis equipos</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-500 to-green-700 text-white p-8 rounded-2xl shadow-lg">
                            <h4 class="text-5xl font-black mb-2">0</h4>
                            <p class="text-lg opacity-90">Mis proyectos</p>
                        </div>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="{{ route('eventos.index') }}" class="group flex items-center gap-4 p-6 bg-gradient-to-br from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 rounded-2xl transition transform hover:-translate-y-1">
                            <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white group-hover:shadow-lg transition">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-black text-gray-900 group-hover:text-indigo-600 transition">Explorar Eventos</h4>
                                <p class="text-gray-600">Descubre todos los eventos disponibles</p>
                            </div>
                        </a>

                        <a href="{{ route('equipos.index') }}" class="group flex items-center gap-4 p-6 bg-gradient-to-br from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 rounded-2xl transition transform hover:-translate-y-1">
                            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white group-hover:shadow-lg transition">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-black text-gray-900 group-hover:text-blue-600 transition">Mis Equipos</h4>
                                <p class="text-gray-600">Gestiona tus equipos de proyecto</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
