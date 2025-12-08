<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ $title ?? 'EventMaster' }} - Sistema de Eventos Universitarios
    </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 via-white to-purple-50 text-gray-900 min-h-screen">

    <div class="min-h-screen flex flex-col">

<<<<<<< HEAD
=======
        <!-- NAVBAR PÚBLICA -->
       
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807

        <!-- MENSAJES FLASH (opcional en páginas públicas) -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto px-6 mt-8">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-2xl p-6 shadow-lg flex items-center gap-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-lg font-semibold">{{ session('success') }}</p>
                </div>
<<<<<<< HEAD
=======
            </div>
        @endif

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1">
            {{ $slot }}
        </main>

        <!-- FOOTER PÚBLICO -->
        <footer class="bg-gray-900 text-white py-16 mt-20">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                            <span class="text-2xl font-black">E</span>
                        </div>
                        <span class="text-2xl font-bold">EventMaster</span>
                    </div>
                    <p class="text-gray-400">
                        El sistema #1 para gestionar eventos, hackathons y concursos universitarios.
                    </p>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-5">Enlaces</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#eventos" class="hover:text-white transition">Eventos</a></li>
                        <li><a href="#sobre" class="hover:text-white transition">Sobre nosotros</a></li>
                        <li><a href="#contacto" class="hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-5">Legal</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Términos de uso</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacidad</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-5">Contacto</h4>
                    <p class="text-gray-400">
                        hola@eventmaster.edu.mx<br>
                        +52 55 1234 5678
                    </p>
                </div>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
            </div>
        @endif

<<<<<<< HEAD
        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1">
            {{ $slot }}
        </main>

=======
            <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-gray-800 text-center text-gray-500">
                <p>© {{ date('Y') }} EventMaster • Hecho con Laravel 12</p>
            </div>
        </footer>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
    </div>

    @stack('scripts')
</body>
</html>