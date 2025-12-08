<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }} @if(!empty($title)) - @endif {{ config('app.name', 'EventMaster') }}</title>

    <!-- Favicon & Fonts -->
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl"></div>
                <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    EventMaster
                </span>
            </a>

            <div class="hidden lg:flex items-center gap-10">
                <a href="{{ route('eventos.index') }}" class="font-medium hover:text-purple-600 transition">Eventos</a>
                <a href="{{ route('equipos.index') }}" class="font-medium hover:text-purple-600 transition">Equipos</a>
                <a href="{{ route('contact') }}" class="font-medium hover:text-purple-600 transition">Contacto</a>
            </div>

            <div class="flex items-center gap-4">
                @guest
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="font-semibold hover:text-purple-600">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-full shadow-lg transition">
                            Registrarse
                        </a>
                    </div>
                @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 hover:bg-gray-100 px-4 py-2 rounded-xl transition">
                            <img src="{{ auth()->user()->foto_perfil ? Storage::url(auth()->user()->foto_perfil) : asset('images/avatar.svg') }}"
                                 alt="Avatar" class="w-10 h-10 rounded-full object-cover ring-4 ring-purple-100">
                            <span class="font-semibold">{{ Str::limit(auth()->user()->name, 15) }}</span>
                            <svg class="w-5 h-5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <!-- Dropdown usuario (igual que antes) -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-4 w-64 bg-white rounded-2xl shadow-2xl border...">...</div>
                    </div>
                @endguest

                <!-- Botón hamburguesa móvil -->
                <button x-data @click="$dispatch('toggle-mobile-menu')"
                        class="lg:hidden p-3 rounded-xl hover:bg-gray-100 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- MENÚ MÓVIL QUE BAJA DESDE ARRIBA (NUEVO) -->
    <div x-data="{ mobileMenuOpen: false }"
         @toggle-mobile-menu.window="mobileMenuOpen = !mobileMenuOpen"
         class="fixed inset-x-0 top-0 z-50 transform transition-transform duration-300 ease-in-out lg:hidden"
         :class="{ '-translate-y-full': !mobileMenuOpen, 'translate-y-0': mobileMenuOpen }">

        <div class="bg-white shadow-2xl">
            <!-- Header del menú móvil -->
            <div class="flex items-center justify-between p-6 border-b">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl"></div>
                    <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">EventMaster</span>
                </div>
                <button @click="mobileMenuOpen = false" class="p-2 hover:bg-gray-100 rounded-lg transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Contenido del menú -->
            <nav class="px-6 py-8 space-y-2">
                <a href="{{ route('eventos.index') }}" @click="mobileMenuOpen = false"
                   class="block py-4 px-6 text-lg font-medium rounded-xl hover:bg-purple-50 transition">Eventos</a>
                <a href="{{ route('equipos.index') }}" @click="mobileMenuOpen = false"
                   class="block py-4 px-6 text-lg font-medium rounded-xl hover:bg-purple-50 transition">Equipos</a>
                <a href="#features" @click="mobileMenuOpen = false"
                   class="block py-4 px-6 text-lg font-medium rounded-xl hover:bg-purple-50 transition">Características</a>
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
                   class="block py-4 px-6 text-lg font-medium rounded-xl hover:bg-purple-50 transition">Contacto</a>

                <div class="border-t pt-8 mt-6">
                    @guest
                        <a href="{{ route('login') }}" @click="mobileMenuOpen = false"
                           class="block w-full text-center py-4 border border-gray-300 rounded-xl font-semibold mb-3">Iniciar sesión</a>
                        <a href="{{ route('register') }}" @click="mobileMenuOpen = false"
                           class="block w-full text-center py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg">
                            Crear cuenta gratis
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false"
                           class="block w-full text-center py-4 bg-purple-100 text-purple-700 font-bold rounded-xl">
                            Ir al Panel
                        </a>
                    @endguest
                </div>
            </nav>
        </div>
    </div>

    <!-- FLASH MESSAGE -->
    @if(session('success'))
        <div class="fixed top-20 left-1/2 -translate-x-1/2 z-50">
            <div class="bg-green-500 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-pulse">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">...</svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- CONTENIDO -->
    <main class="flex-1">
        {{ $slot }}
    </main>

    <!-- BOTÓN VOLVER ARRIBA -->
    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
            x-data
            x-show="window.pageYOffset > 500"
            x-transition
            class="fixed bottom-6 right-6 z-40 w-14 h-14 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full shadow-2xl hover:shadow-purple-500/50 flex items-center justify-center hover:scale-110 transition-all duration-300">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7"/>
        </svg>
    </button>

    <!-- Footer simple (puedes usar el premium del mensaje anterior si quieres) -->
    <footer class="bg-gray-950 text-gray-400">
        <div class="max-w-7xl mx-auto px-6 py-16 lg:py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12">

                <!-- Columna 1: Brand + Descripción -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl"></div>
                        <span class="text-3xl font-black text-white">EventMaster</span>
                    </div>
                    <p class="text-gray-400 leading-relaxed max-w-md">
                        La plataforma líder en Latinoamérica para organizar hackathons, olimpiadas científicas, 
                        competencias de innovación y conectar estudiantes multidisciplinarios.
                    </p>

                    <div class="flex gap-4 mt-4 mt-8">
                        <a href="www.facebook.com" class="w-12 h-12 bg-gray-800 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="www.twitter.com" class="w-12 h-12 bg-gray-800 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="www.github.com" class="w-12 h-12 bg-gray-800 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="www.linkedin.com" class="w-12 h-12 bg-gray-800 hover:bg-purple-600 rounded-xl flex items-center justify-center transition-all hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v-11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Columna 2: Plataforma -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Plataforma</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('eventos.index') }}" class="hover:text-purple-400 transition">Próximos eventos</a></li>
                        <li><a href="{{ route('equipos.index') }}" class="hover:text-purple-400 transition">Crear equipo</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Cómo funciona</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Precios y planes</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Recursos -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Recursos</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="hover:text-purple-400 transition">Blog</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Guías y tutoriales</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Casos de éxito</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Webinars</a></li>
                    </ul>
                </div>

                <!-- Columna 4: Empresa -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6">Empresa</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="hover:text-purple-400 transition">Sobre nosotros</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Alianzas universitarias</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Prensa y medios</a></li>
                        <li><a href="#" class="hover:text-purple-400 transition">Trabaja con nosotros</a></li>
                    </ul>
                </div>

            </div>

            <!-- Línea divisoria + Copyright -->
            <div class="border-t border-gray-800 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm">
                <p class="text-gray-500">
                    © {{ date('Y') }} <span class="text-white font-semibold">EventMaster</span>. Todos los derechos reservados.
                </p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-purple-400 transition">Términos de uso</a>
                    <a href="#" class="hover:text-purple-400 transition">Política de privacidad</a>
                    <a href="#" class="hover:text-purple-400 transition">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>