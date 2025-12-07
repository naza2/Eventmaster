<x-app-layout>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-gray-900 mb-4">Contáctanos</h1>
                <p class="text-xl text-gray-600">¿Tienes preguntas? Estamos aquí para ayudarte</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Formulario -->
                <div class="border-2 border-gray-200 rounded-2xl p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Envianos un mensaje</h2>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nombre completo</label>
                            <input type="text" name="nombre" required value="{{ old('nombre') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition">
                            @error('nombre')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Correo electrónico</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Asunto</label>
                            <input type="text" name="asunto" required value="{{ old('asunto') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent transition">
                            @error('asunto')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full py-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-full transition shadow-lg text-lg">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>

                <!-- Información de contacto -->
                <div class="border-2 border-gray-200 rounded-2xl p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Información de contacto</h2>

                    <div class="space-y-6">
                        <!-- Dirección -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Direccion</h3>
                                <p class="text-gray-600">Universidad Tecnológica<br>Ciudad, Estado, C.P.</p>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Telefono</h3>
                                <p class="text-gray-600">+52 (123) 456-7890</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">contacto@eventmaster.com</p>
                            </div>
                        </div>

                        <!-- Horario -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-1">Horario</h3>
                                <p class="text-gray-600">Lunes a Viernes<br>9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</x-app-layout>
