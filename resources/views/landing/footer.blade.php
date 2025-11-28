{{-- resources/views/landing/footer.blade.php --}}
<footer class="bg-gray-900 text-white py-16 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-12">

            {{-- Logo y descripción --}}
            <div class="md:col-span-1">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 text-3xl font-bold">EventMaster</span>
                </div>
                <p class="text-gray-400 leading-relaxed">
                    Plataforma líder en gestión de eventos y competencias académicas universitarias. 
                    Conecta talento, mide progreso y celebra logros.
                </p>
                <div class="mt-6 flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-purple-600 transition">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>

            {{-- Enlaces rápidos --}}
            <div>
                <h3 class="text-xl font-bold mb-6">Enlaces rápidos</h3>
                <ul class="space-y-4 text-gray-400">
                    <li><a href="#inicio" class="hover:text-white transition">Inicio</a></li>
                    <li><a href="#eventos" class="hover:text-white transition">Eventos</a></li>
                    <li><a href="#equipos" class="hover:text-white transition">Equipos</a></li>
                    <li><a href="#contacto" class="hover:text-white transition">Contacto</a></li>
                </ul>
            </div>

            {{-- Recursos --}}
            <div>
                <h3 class="text-xl font-bold mb-6">Recursos</h3>
                <ul class="space-y-4 text-gray-400">
                    <li><a href="#" class="hover:text-white transition">Guía para participantes</a></li>
                    <li><a href="#" class="hover:text-white transition">Reglamento general</a></li>
                    <li><a href="#" class="hover:text-white transition">Preguntas frecuentes</a></li>
                    <li><a href="#" class="hover:text-white transition">Blog</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h3 class="text-xl font-bold mb-6">Suscríbete</h3>
                <p class="text-gray-400 mb-4">
                    Recibe notificaciones de nuevos eventos y actualizaciones
                </p>
                <form class="flex">
                    <input type="email" placeholder="tu@email.com"
                        class="flex-1 px-5 py-3 rounded-l-xl text-gray-900 focus:outline-none">
                    <button class="bg-purple-600 px-6 py-3 rounded-r-xl font-bold hover:bg-purple-700 transition">
                        Suscribirse
                    </button>
                </form>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p class="text-gray-400">
                © {{ date('Y') }} <span class="text-purple-400 font-semibold">EventMaster</span>. Todos los derechos reservados.
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Hecho con <span class="text-red-500">♥</span> para la comunidad universitaria
            </p>
        </div>
    </div>
</footer>