<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventMaster - Gestión de Eventos Académicos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700|inter:400,500,600,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 antialiased" x-data="{ mobileMenu: false }">

{{-- Navigation --}}
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="ml-3 text-2xl font-bold">EventMaster</span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#inicio" class="text-gray-700 hover:text-purple-600 font-medium nav-link nav-active" data-section="inicio">Inicio</a>
                <a href="#eventos" class="text-gray-700 hover:text-purple-600 font-medium nav-link" data-section="eventos">Eventos</a>
                <a href="#equipos" class="text-gray-700 hover:text-purple-600 font-medium nav-link" data-section="equipos">Equipos</a>
                <a href="#contacto" class="text-gray-700 hover:text-purple-600 font-medium nav-link" data-section="contacto">Contacto</a>
            </div>

            <!-- Auth Buttons (Desktop) -->
            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <button onclick="showModal('loginModal')" class="bg-white text-purple-600 px-6 py-2 rounded-lg font-semibold border border-purple-600 hover:bg-purple-50 transition">
                        Iniciar Sesión
                    </button>
                    <button onclick="showModal('registerModal')" class="bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                        Registrarse
                    </button>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-purple-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-purple-700 transition">
                        Dashboard
                    </a>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button @click="mobileMenu = !mobileMenu" class="text-gray-700 hover:text-purple-600 focus:outline-none">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenu" x-transition class="md:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#inicio" class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg nav-link" data-section="inicio">Inicio</a>
            <a href="#eventos" class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg nav-link" data-section="eventos">Eventos</a>
            <a href="#equipos" class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg nav-link" data-section="equipos">Equipos</a>
            <a href="#contacto" class="block px-4 py-3 text-gray-700 hover:bg-purple-50 hover:text-purple-600 rounded-lg nav-link" data-section="contacto">Contacto</a>
            <div class="pt-4 border-t border-gray-200 mt-4">
                @guest
                    <button onclick="showModal('loginModal')" class="w-full text-left px-4 py-3 text-purple-600 font-semibold">Iniciar Sesión</button>
                    <button onclick="showModal('registerModal')" class="w-full text-left px-4 py-3 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700">Registrarse</button>
                @else
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 bg-purple-600 text-white rounded-lg font-semibold text-center">Ir al Dashboard</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

{{-- Contenido principal --}}
@include('landing.inicio')
@include('landing.eventos')
@include('landing.equipos')
@include('landing.contacto')

{{-- Footer --}}
@include('landing.footer')

@livewireScripts

<script>
    // Mostrar/Ocultar secciones
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const section = this.getAttribute('data-section');

            // Ocultar todas
            document.querySelectorAll('main section').forEach(s => s.classList.add('hidden'));
            document.getElementById('section-' + section).classList.remove('hidden');

            // Activar link
            document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('nav-active'));
            this.classList.add('nav-active');

            // Cerrar menú móvil
            window.dispatchEvent(new CustomEvent('close-mobile-menu'));
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // Función global para modales
    function showModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.getElementById(id).classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function hideModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.getElementById(id).classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Cerrar al hacer click fuera
    window.addEventListener('click', e => {
        if (e.target.classList.contains('modal-backdrop')) {
            hideModal('loginModal');
            hideModal('registerModal');
        }
    });

    // Mostrar Inicio por defecto
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('main section').forEach(s => s.classList.add('hidden'));
        document.getElementById('section-inicio').classList.remove('hidden');
        document.querySelector('[data-section="inicio"]').classList.add('nav-active');
    });

    // Cerrar menú móvil al hacer click en enlace
    window.addEventListener('close-mobile-menu', () => {
        document.querySelector('[x-data]').__instance]').__x.$data.mobileMenu = false;
    });
</script>
</body>
</html>