<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Error del Servidor | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full">
        <!-- Animación de error 500 -->
        <div class="text-center mb-12">
            <div class="inline-block relative">
                <h1 class="text-[180px] font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-400 leading-none">
                    500
                </h1>
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full opacity-30 blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full opacity-30 blur-2xl"></div>
            </div>
        </div>

        <!-- Card de contenido -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-10 text-center">
            <div class="mb-8">
                <svg class="w-24 h-24 mx-auto text-red-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>

                <h2 class="text-4xl font-black text-white mb-4">
                    Error del Servidor
                </h2>

                <p class="text-xl text-gray-200 mb-2">
                    Algo salió mal en nuestros servidores.
                </p>

                <p class="text-gray-400">
                    Nuestro equipo ha sido notificado y está trabajando para solucionar el problema.
                </p>
            </div>

            <!-- Información técnica (solo en desarrollo) -->
            @if(config('app.debug') && isset($exception))
            <div class="bg-red-900/30 border-l-4 border-red-500 rounded-lg p-6 mb-8 text-left">
                <p class="text-red-300 font-mono text-sm mb-2">
                    <strong>Error:</strong> {{ $exception->getMessage() }}
                </p>
                <p class="text-red-400 font-mono text-xs">
                    {{ $exception->getFile() }}:{{ $exception->getLine() }}
                </p>
            </div>
            @endif

            <!-- Sugerencias -->
            <div class="bg-white/5 rounded-2xl p-6 mb-8">
                <p class="text-gray-300 font-semibold mb-4">Mientras tanto, puedes intentar:</p>
                <ul class="text-left text-gray-400 space-y-2">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Refrescar la página en unos momentos</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Volver a la página anterior y reintentar</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-purple-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Contactar al soporte si el problema persiste</span>
                    </li>
                </ul>
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

                <button onclick="window.location.reload()"
                   class="px-8 py-4 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Recargar Página
                </button>
            </div>

            <!-- ID de error para soporte -->
            <div class="mt-10 pt-8 border-t border-white/10">
                <p class="text-gray-500 text-sm">
                    Código de referencia: <span class="font-mono text-purple-400">{{ uniqid('ERR-') }}</span>
                </p>
            </div>
        </div>

        <!-- Footer pequeño -->
        <p class="text-center text-gray-400 mt-8">
            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </p>
    </div>

</body>
</html>
