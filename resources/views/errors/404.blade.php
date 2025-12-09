<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página No Encontrada | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full">
        <!-- Animación de error 404 -->
        <div class="text-center mb-12">
            <div class="inline-block relative">
                <h1 class="text-[180px] font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 leading-none">
                    404
                </h1>
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-gradient-to-br from-indigo-400 to-purple-400 rounded-full opacity-20 blur-2xl"></div>
            </div>
        </div>

        <!-- Card de contenido -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-10 text-center">
            <div class="mb-8">
                <svg class="w-24 h-24 mx-auto text-purple-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                <h2 class="text-4xl font-black text-gray-900 mb-4">
                    ¡Oops! Página No Encontrada
                </h2>

                <p class="text-xl text-gray-600 mb-2">
                    La página que buscas no existe o fue movida.
                </p>

                <p class="text-gray-500">
                    No te preocupes, te ayudaremos a encontrar lo que necesitas.
                </p>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Ir al Inicio
                </a>

                <a href="javascript:history.back()"
                   class="px-8 py-4 bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-800 font-bold text-lg rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver Atrás
                </a>
            </div>

            <!-- Enlaces útiles -->
            <div class="mt-10 pt-8 border-t border-gray-200">
                <p class="text-gray-600 font-semibold mb-4">O explora estas opciones:</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('eventos.index') }}" class="text-purple-600 hover:text-purple-700 font-semibold hover:underline">Ver Eventos</a>
                    <span class="text-gray-300">•</span>
                    <a href="{{ route('equipos.index') }}" class="text-purple-600 hover:text-purple-700 font-semibold hover:underline">Ver Equipos</a>
                    @auth
                    <span class="text-gray-300">•</span>
                    <a href="{{ route('dashboard') }}" class="text-purple-600 hover:text-purple-700 font-semibold hover:underline">Mi Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Footer pequeño -->
        <p class="text-center text-gray-500 mt-8">
            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </p>
    </div>

</body>
</html>
