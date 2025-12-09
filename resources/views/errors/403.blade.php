<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Acceso Denegado | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full">
        <!-- Animación de error 403 -->
        <div class="text-center mb-12">
            <div class="inline-block relative">
                <h1 class="text-[180px] font-black text-transparent bg-clip-text bg-gradient-to-r from-red-600 via-orange-600 to-yellow-600 leading-none">
                    403
                </h1>
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-gradient-to-br from-red-400 to-orange-400 rounded-full opacity-20 blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-gradient-to-br from-yellow-400 to-red-400 rounded-full opacity-20 blur-2xl"></div>
            </div>
        </div>

        <!-- Card de contenido -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 p-10 text-center">
            <div class="mb-8">
                <svg class="w-24 h-24 mx-auto text-red-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>

                <h2 class="text-4xl font-black text-gray-900 mb-4">
                    Acceso Denegado
                </h2>

                <p class="text-xl text-gray-600 mb-2">
                    No tienes permiso para acceder a esta página.
                </p>

                <p class="text-gray-500">
                    {{ $exception->getMessage() ?: 'Esta acción requiere permisos especiales que tu cuenta no posee.' }}
                </p>
            </div>

            <!-- Información adicional -->
            <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl p-6 mb-8">
                <p class="text-gray-700 font-semibold mb-2">¿Por qué veo este error?</p>
                <ul class="text-left text-gray-600 space-y-2">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Tu rol de usuario no tiene los permisos necesarios</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Esta acción está restringida para administradores o líderes</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Intentaste acceder a recursos de otro usuario</span>
                    </li>
                </ul>
            </div>

            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}"
                   class="px-8 py-4 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-red-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
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

            <!-- Contacto -->
            <div class="mt-10 pt-8 border-t border-gray-200">
                <p class="text-gray-600">
                    Si crees que esto es un error, contacta al administrador del sistema.
                </p>
            </div>
        </div>

        <!-- Footer pequeño -->
        <p class="text-center text-gray-500 mt-8">
            © {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
        </p>
    </div>

</body>
</html>
