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
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>

<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 via-white to-purple-50 text-gray-900 min-h-screen">

    <div class="min-h-screen flex flex-col">


        <!-- MENSAJES FLASH (opcional en páginas públicas) -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto px-6 mt-8">
                <div class="bg-green-50 border border-green-200 text-green-800 rounded-2xl p-6 shadow-lg flex items-center gap-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-lg font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- CONTENIDO PRINCIPAL -->
        <main class="flex-1">
            {{ $slot }}
        </main>

    </div>

    @stack('scripts')
</body>
</html>