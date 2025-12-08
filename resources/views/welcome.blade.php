<x-app-layout>
    <!-- HERO SECTION -->
<<<<<<< HEAD
    <section class="relative overflow-hidden bg-gradient-to-br from-purple-50 via-white to-blue-50 py-24 lg:py-32">
        <div class="absolute inset-0 bg-grid-purple-100/30 [mask-image:radial-gradient(ellipse_at_center,transparent_20%,black)]"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 xl:gap-20 items-center">
                <!-- Texto -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-medium mb-6">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                        </span>
                        Plataforma oficial para competencias académicas
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-gray-900 leading-tight">
                        Organiza y gana<br>
                        <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            eventos académicos
                        </span>
                    </h1>

                    <p class="mt-8 text-xl lg:text-2xl text-gray-600 leading-relaxed max-w-2xl">
                        La plataforma #1 para crear hackathons, olimpiadas científicas, concursos de innovación 
                        y formar equipos multidisciplinarios que destaquen.
                    </p>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" 
                           class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-200 text-lg">
                            Comenzar gratis
                        </a>
                        <a href="#features" 
                           class="px-8 py-4 bg-white hover:bg-gray-50 text-gray-800 font-semibold rounded-2xl border-2 border-gray-200 hover:border-gray-300 transition-all duration-200 text-lg">
                            Ver cómo funciona
                        </a>
                    </div>

                    <div class="mt-12 flex items-center gap-8 justify-center lg:justify-start text-sm text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Sin tarjeta requerida
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            Certificados automáticos
                        </div>
                    </div>
                </div>

                <!-- Ilustración moderna (usando un SVG profesional o placeholder premium) -->
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-purple-400 to-pink-400 rounded-3xl blur-3xl opacity-20"></div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&q=80&w=800&h=800"
                         alt="Estudiantes colaborando en evento académico"
                         class="relative rounded-3xl shadow-2xl w-full h-auto object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- CARACTERÍSTICAS -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900">Todo lo que necesitas</h2>
                <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                    Herramientas profesionales para organizar eventos académicos de alto impacto
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @php
                    $features = [
                        [
                            'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422A12.083 12.083 0 0112 21.5c-2.4 0-4.6-.7-6.5-2.1L12 14z',
                            'title' => 'Gestión completa de eventos',
                            'desc' => 'Crea hackathons, olimpiadas, ferias de proyectos y más con plantillas listas para usar.',
                            'color' => 'from-purple-500 to-pink-500'
                        ],
                        [
                            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                            'title' => 'Equipos multidisciplinarios',
                            'desc' => 'Conecta estudiantes de ingeniería, diseño, negocios, medicina y más en un solo lugar.',
                            'color' => 'from-blue-500 to-cyan-500'
                        ],
                        [
                            'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'title' => 'Certificados y seguimiento',
                            'desc' => 'Generación automática de constancias con blockchain (opcional) y dashboard en tiempo real.',
                            'color' => 'from-emerald-500 to-teal-500'
                        ]
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="group relative bg-gradient-to-br {{ $feature['color'] }} p-1 rounded-3xl hover:scale-105 transition-all duration-300">
                        <div class="bg-white rounded-3xl p-8 h-full">
                            <div class="w-16 h-16 bg-gradient-to-br {{ $feature['color'] }} rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PRÓXIMOS EVENTOS -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900">Próximos eventos</h2>
                <p class="mt-4 text-xl text-gray-600">Únete a las competencias académicas más importantes del año</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $events = [
                        [
                            'title' => 'Hackathon Nacional 2025',
                            'category' => 'Desarrollo y Tecnología',
                            'date' => '15-17 Marzo 2025',
                            'prize' => '$150,000 MXN en premios',
                            'image' => 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?ixlib=rb-4.0.3&auto=format&fit=crop&q=80',
                            'gradient' => 'from-purple-500 to-pink-500'
                        ],
                        [
                            'title' => 'Olimpiada de Robótica',
                            'category' => 'Ingeniería y Robótica',
                            'date' => '10-12 Abril 2025',
                            'prize' => 'Viaje a competencia internacional',
                            'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?ixlib=rb-4.0.3&auto=format&fit=crop&q=80',
                            'gradient' => 'from-blue-500 to-cyan-500'
                        ],
                        [
                            'title' => 'Concurso de Emprendimiento',
                            'category' => 'Negocios e Innovación',
                            'date' => '20-22 Mayo 2025',
                            'prize' => 'Incubación + $200,000 MXN',
                            'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&q=80',
                            'gradient' => 'from-emerald-500 to-teal-500'
                        ]
                    ];
                @endphp

                @foreach($events as $event)
                    <div class="group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-3">
                        <div class="absolute inset-0 bg-gradient-to-t {{ $event['gradient'] }} opacity-70"></div>
                        <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}" class="w-full h-64 object-cover">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                        
                        <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                            <span class="text-sm font-semibold uppercase tracking-wider text-gray-200">{{ $event['category'] }}</span>
                            <h3 class="mt-2 text-2xl font-bold">{{ $event['title'] }}</h3>
                            <p class="mt-2 text-lg">{{ $event['date'] }}</p>
                            <p class="mt-3 text-sm font-medium bg-white/20 backdrop-blur rounded-full px-4 py-2 inline-block">
                                {{ $event['prize'] }}
                            </p>
                            <a href="{{ route('equipos.index') }}"
                                class="mt-6 w-full inline-block text-center py-3 bg-white text-gray-900 font-bold rounded-2xl hover:bg-gray-100 transition duration-200 shadow-md hover:shadow-lg">
                                    Inscribir equipo →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('eventos.index') }}" class="inline-flex items-center gap-3 text-purple-600 font-bold text-lg hover:gap-5 transition-all">
                    Ver todos los eventos
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</x-app-layout>
=======
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
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
