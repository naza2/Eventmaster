{{-- resources/views/landing/contacto.blade.php --}}
<section id="section-contacto" class="min-h-screen hidden py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Contáctanos
            </h2>
            <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">
                ¿Tienes dudas? ¿Quieres organizar un evento con nosotros? Estamos aquí para ayudarte
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Formulario de Contacto --}}
            <div class="bg-white rounded-3xl shadow-2xl p-10 hover:shadow-3xl transition">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">
                    Envíanos un mensaje
                </h3>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre completo</label>
                        <input type="text" name="name" required
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-600 transition text-lg"
                            placeholder="Juan Pérez">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                        <input type="email" name="email" required
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-600 transition text-lg"
                            placeholder="juan@ejemplo.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Asunto</label>
                        <input type="text" name="subject" required
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-600 transition text-lg"
                            placeholder="Organización de evento">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Mensaje</label>
                        <textarea name="message" rows="6" required
                            class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-600 transition text-lg resize-none"
                            placeholder="Hola, me gustaría..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-5 rounded-xl font-bold text-xl hover:from-purple-700 hover:to-indigo-700 transform hover:scale-105 transition shadow-lg">
                        Enviar Mensaje
                    </button>
                </form>
            </div>

            {{-- Información de Contacto --}}
            <div class="space-y-10">
                <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-3xl shadow-2xl p-10 text-white">
                    <h3 class="text-2xl font-bold mb-8">Información de contacto</h3>

                    <div class="space-y-8 text-lg">
                        <div class="flex items-start">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur">
                                <i class="fas fa-map-marker-alt text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Dirección</h4>
                                <p class="opacity-90">Av. Universidad 1000<br>Ciudad Universitaria, CP 12345</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur">
                                <i class="fas fa-phone text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Teléfono</h4>
                                <p class="opacity-90">+52 (123) 456-7890</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur">
                                <i class="fas fa-envelope text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Correo</h4>
                                <p class="opacity-90">hola@eventmaster.edu.mx</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="w-14 h-14 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mr-6 backdrop-blur">
                                <i class="fas fa-clock text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Horario de atención</h4>
                                <p class="opacity-90">Lunes a Viernes<br>9:00 – 18:00 hrs</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mapa pequeño (opcional) --}}
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.492434294963!2d-99.16896868505483!3d19.43260148705077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ff4f8f9c3d8d%3A0x5b1c4e8f8f8f8f8f!2sUniversidad%20Nacional%20Aut%C3%B3noma%20de%20M%C3%A9xico!5e0!3m2!1ses!2smx!4v1630000000000!5m2!1ses!2smx"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>