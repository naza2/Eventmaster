<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EventMaster') }} @if(isset($title)) - {{ $title }}@endif</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900 min-h-screen">

    <div class="flex flex-col min-h-screen">

        <!-- NAVBAR -->
        <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
            <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">
                    EventMaster
                </a>

                <!-- Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('eventos.index') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">
                        Eventos
                    </a>
                    <a href="{{ route('equipos.index') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">
                        Equipos
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">
                        Contacto
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-700 font-semibold transition">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full transition shadow-md">
                            Registrarse
                        </a>
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-3 hover:bg-gray-100 px-4 py-2 rounded-xl transition">
                                <img src="{{ auth()->user()->foto_perfil ? Storage::url(auth()->user()->foto_perfil) : asset('images/avatar.svg') }}" alt="Avatar" class="w-10 h-10 rounded-full ring-4 ring-purple-100 object-cover">
                                <span class="font-medium text-gray-800">{{ Str::limit(auth()->user()->name, 20) }}</span>
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 py-3 overflow-hidden">
                                <div class="px-5 py-3 border-b border-gray-100">
                                    <p class="text-sm text-gray-600">Sesión iniciada como</p>
                                    <p class="font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}" class="block px-5 py-3 hover:bg-purple-50 text-gray-700 transition">
                                    Mi Panel
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-5 py-3 hover:bg-purple-50 text-gray-700 transition">
                                    Mi Perfil
                                </a>
                                <hr class="border-gray-200 my-2">
                                <form method="POST" action="{{ route('logout') }}" class="px-5">
                                    @csrf
                                    <button type="submit" class="w-full text-left py-3 text-red-600 hover:bg-red-50 rounded-lg transition font-medium">
                                        Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </nav>
        </header>

        <!-- MENSAJES FLASH -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-6 mt-6">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-5 shadow-md">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- FOOTER -->
        <footer class="bg-gradient-to-b from-slate-800 to-slate-900 mt-auto">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- EventMaster Info -->
                    <div>
                        <h3 class="text-xl font-bold text-white mb-3">EventMaster</h3>
                        <p class="text-gray-300 text-sm">
                            Plataforma líder en gestión de eventos académicos y competencias estudiantiles
                        </p>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Enlaces rápidos</h4>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white text-sm transition">Inicio</a></li>
                            <li><a href="{{ route('eventos.index') }}" class="text-gray-300 hover:text-white text-sm transition">Eventos</a></li>
                            <li><a href="{{ route('equipos.index') }}" class="text-gray-300 hover:text-white text-sm transition">Equipos</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white text-sm transition">Contacto</a></li>
                        </ul>
                    </div>

                    <!-- Síguenos -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Síguenos</h4>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 bg-slate-700 hover:bg-purple-600 rounded-full flex items-center justify-center transition">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-slate-700 hover:bg-purple-600 rounded-full flex items-center justify-center transition">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-slate-700 hover:bg-purple-600 rounded-full flex items-center justify-center transition">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>zz