<x-app-layout>
    <!-- HERO SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Side - Text -->
                <div>
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Gestiona tus<br>
                        eventos<br>
                        <span class="text-purple-600">académicos</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        La plataforma perfecta para organizar, participar y ganar
                        en competencias académicas con equipos
                        multidisciplinarios.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full transition shadow-lg">
                            Comenzar ahora
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-full transition">
                            Iniciar Sesión
                        </a>
                    </div>
                </div>

                <!-- Right Side - Illustration -->
                <div class="flex justify-center">
                    <div class="w-full max-w-lg">
                        <svg viewBox="0 0 500 500" class="w-full h-auto">
                            <!-- Robot Illustration Placeholder -->
                            <rect x="150" y="100" width="200" height="250" fill="#E5E7EB" rx="20"/>
                            <circle cx="250" cy="180" r="60" fill="#D1D5DB"/>
                            <rect x="180" y="220" width="50" height="8" fill="#9CA3AF"/>
                            <rect x="270" y="220" width="50" height="8" fill="#9CA3AF"/>
                            <polygon points="200,80 300,80 280,50" fill="#F59E0B"/>
                            <polygon points="250,350 200,450 300,450" fill="#374151"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CARACTERÍSTICAS PRINCIPALES -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Características principales</h2>
                <p class="text-xl text-gray-600">Todo lo que necesitas para gestionar eventos académicos exitosos</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Gestión de Eventos</h3>
                    <p class="text-gray-600">Crea y organiza eventos académicos de manera sencilla y eficiente</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Equipo Multidisciplinarios</h3>
                    <p class="text-gray-600">Forma equipos con estudiantes de diferentes carreras y especialidades</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Seguimiento de Progreso</h3>
                    <p class="text-gray-600">Monitorea el avance de los proyectos y genera constancias automáticas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRÓXIMOS EVENTOS -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Próximos Eventos</h2>
                <p class="text-xl text-gray-600">Descubre y participa en los eventos académicos más emocionantes</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Event Card 1 - Blue -->
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-3xl p-8 hover:shadow-xl transition">
                    <div class="h-48 mb-6"></div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Hackathon 2024</h3>
                    <p class="text-gray-700 mb-6">Competencia de desarrollo de software para estudiantes.</p>
                    <select class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option>September</option>
                    </select>
                    <button class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full transition">
                        Participar
                    </button>
                </div>

                <!-- Event Card 2 - Green -->
                <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-3xl p-8 hover:shadow-xl transition">
                    <div class="h-48 mb-6"></div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Equipo Multidisciplinarios</h3>
                    <p class="text-gray-700 mb-6">Forma equipos con estudiantes de diferentes carreras y especialidades</p>
                    <select class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option>September</option>
                    </select>
                    <button class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full transition">
                        Participar
                    </button>
                </div>

                <!-- Event Card 3 - Pink -->
                <div class="bg-gradient-to-br from-pink-100 to-pink-200 rounded-3xl p-8 hover:shadow-xl transition">
                    <div class="h-48 mb-6"></div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Seguimiento de Progreso</h3>
                    <p class="text-gray-700 mb-6">Monitorea el avance de los proyectos y genera constancias automáticas.</p>
                    <select class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg bg-white">
                        <option>September</option>
                    </select>
                    <button class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full transition">
                        Participar
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
