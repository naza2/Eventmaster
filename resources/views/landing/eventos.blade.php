{{-- resources/views/landing/eventos.blade.php --}}
<section id="section-eventos" class="min-h-screen hidden py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Próximos Eventos
            </h2>
            <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                Descubre y participa en los eventos académicos más emocionantes del año
            </p>
        </div>

        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            <!-- Evento 1 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="h-52 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-code text-white text-7xl"></i>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Hackathon 2025</h3>
                    <p class="text-gray-600 mb-6">
                        Competencia de desarrollo de software para estudiantes. 48 horas non-stop para crear soluciones reales.
                    </p>
                    <div class="space-y-3 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-3 text-purple-600"></i>
                            <span>14–16 Marzo 2025</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-purple-600"></i>
                            <span>Campus Central - Auditorio Principal</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users mr-3 text-purple-600"></i>
                            <span>64 equipos inscritos</span>
                        </div>
                    </div>
                    <button class="w-full mt-6 bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-lg">
                        Participar ahora
                    </button>
                </div>
            </div>

            <!-- Evento 2 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="h-52 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center">
                    <i class="fas fa-chart-bar text-white text-7xl"></i>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Data Science Challenge</h3>
                    <p class="text-gray-600 mb-6">
                        Analiza grandes volúmenes de datos reales y presenta insights accionables ante un jurado experto.
                    </p>
                    <div class="space-y-3 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-3 text-teal-600"></i>
                            <span>4–6 Abril 2025</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-teal-600"></i>
                            <span>Facultad de Estadística</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users mr-3 text-teal-600"></i>
                            <span>42 equipos inscritos</span>
                        </div>
                    </div>
                    <button class="w-full mt-6 bg-teal-600 text-white py-3 rounded-xl font-bold hover:bg-teal-700 transition">
                        Inscribirse
                    </button>
                </div>
            </div>

            <!-- Evento 3 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition duration-300">
                <div class="h-52 bg-gradient-to-r from-pink-500 to-rose-600 flex items-center justify-center">
                    <i class="fas fa-paint-brush text-white text-7xl"></i>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Design Sprint Week</h3>
                    <p class="text-gray-600 mb-6">
                        Semana intensiva de diseño UX/UI. Del problema al prototipo funcional en solo 5 días.
                    </p>
                    <div class="space-y-3 text-sm text-gray-500">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-3 text-rose-600"></i>
                            <span>20–24 Mayo 2025</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-rose-600"></i>
                            <span>Centro de Innovación</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-users mr-3 text-rose-600"></i>
                            <span>28 equipos inscritos</span>
                        </div>
                    </div>
                    <button class="w-full mt-6 bg-rose-600 text-white py-3 rounded-xl font-bold hover:bg-rose-700 transition">
                        ¡Quiero participar!
                    </button>
                </div>
            </div>
        </div>

        <!-- Más eventos (puedes duplicar las tarjetas) -->
        <div class="text-center mt-16">
            <a href="#" class="inline-block bg-gray-200 text-gray-700 px-8 py-4 rounded-xl font-semibold hover:bg-gray-300 transition">
                Ver todos los eventos
            </a>
        </div>
    </div>
</section>