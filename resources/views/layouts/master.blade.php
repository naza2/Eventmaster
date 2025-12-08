<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ $title ?? '' }}
        @if(!empty($title)) - @endif
        {{ config('app.name', 'EventMaster') }}
    </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">

    <!-- Fonts modernas (Inter es más limpia que Figtree) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Alpine.js v3 -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen flex flex-col">

    <!-- NAVBAR MODERNA CON GLASS EFFECT -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-gray-200/50">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo con icono -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl shadow-lg group-hover:shadow-xl transition-shadow"></div>
                <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                    EventMaster
                </span>
            </a>

            <!-- Menú Desktop -->
            <div class="hidden lg:flex items-center gap-10">
                <a href="{{ route('eventos.index') }}" class="font-medium hover:text-purple-600 transition">Eventos</a>
                <a href="{{ route('equipos.index') }}" class="font-medium hover:text-purple-600 transition">Equipos</a>
            </div>

            <!-- Auth + Menú móvil -->
            <div class="flex items-center gap-4">
                @guest
                    <div class="hidden md:flex items-center gap-4">
                        <a href="{{ route('login') }}" class="font-semibold hover:text-purple-600 transition">Iniciar sesión</a>
                        <a href="{{ route('register') }}"
                           class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all">
                            Registrarse gratis
                        </a>
                    </div>
                @else
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 hover:bg-gray-100 dark:hover:bg-gray-800 px-4 py-2 rounded-2xl transition">
                            <img src="{{ auth()->user()->foto_perfil ? Storage::url(auth()->user()->foto_perfil) : asset('images/avatar.svg') }}"
                                 alt="Avatar de {{ auth()->user()->name }}"
                                 class="w-10 h-10 rounded-full object-cover ring-4 ring-purple-100">
                            <span class="font-semibold">{{ Str::limit(auth()->user()->name, 15) }}</span>
                            <svg class="w-5 h-5 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                             class="absolute right-0 mt-4 w-72 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100">
                                <p class="text-sm text-gray-600">Conectado como</p>
                                <p class="font-bold text-lg">{{ auth()->user()->name }}</p>
                            </div>
                            <a href="{{ route('dashboard') }}" class="block px-6 py-3 hover:bg-purple-50 transition">Mi Panel</a>
                            <a href="{{ route('profile.edit') }}" class="block px-6 py-3 hover:bg-purple-50 transition">Editar Perfil</a>
                            <hr class="border-gray-200">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-3 text-red-600 hover:bg-red-50 font-medium transition">
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest

                <!-- Botón hamburguesa móvil -->
                <button @click="$dispatch('toggle-mobile-menu')"
                        class="lg:hidden p-3 rounded-xl hover:bg-gray-100 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- MENÚ MÓVIL QUE BAJA DESDE ARRIBA (MODERNO Y FUNCIONAL) -->
    <div x-data="{ mobileMenuOpen: false }"
         @toggle-mobile-menu.window="mobileMenuOpen = !mobileMenuOpen"
         class="fixed inset-x-0 top-0 z-50 transition-transform duration-300 ease-in-out lg:hidden"
         :class="mobileMenuOpen ? 'translate-y-0' : '-translate-y-full'">

        <div class="bg-white/95 backdrop-blur-2xl shadow-2xl border-b border-gray-200">
            <div class="flex items-center justify-between p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl"></div>
                    <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">EventMaster</span>
                </div>
                <button @click="mobileMenuOpen = false" class="p-2 hover:bg-gray-100 rounded-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="px-6 pb-8 space-y-1">
                <a href="{{ route('eventos.index') }}" @click="mobileMenuOpen = false" class="block py-4 px-6 text-lg font-medium rounded-xl hover:bg-purple-50 transition">Eventos</a>
                <a href="{{ route('equipos.index') }}" @click="mobileMenuOpen = false" class="block py-4 px-6 text-lg font-medium rounded-xl hover:bg-purple-50 transition">Equipos</a>
               

                <div class="border-t border-gray-200 pt-6 mt-4">
                    @guest
                        <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="block w-full text-center py-4 border border-gray-300 rounded-xl font-semibold mb-3">Iniciar sesión</a>
                        <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="block w-full text-center py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold rounded-xl shadow-lg">
                            Crear cuenta gratis
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="block w-full text-center py-4 bg-purple-100 text-purple-700 font-bold rounded-xl">
                            Ir al Panel
                        </a>
                    @endguest
                </div>
            </nav>
        </div>
    </div>

    <!-- FLASH MESSAGES MODERNOS -->
    @if(session('success'))
        <div class="fixed top-20 left-1/2 -translate-x-1/2 z-50 animate-pulse">
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-8 py-4 rounded-2xl shadow-2xl flex items-center gap-3 font-bold">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-1">
        @yield('content')
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

    @stack('scripts')
</body>
</html>