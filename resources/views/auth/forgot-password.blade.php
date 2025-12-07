{{-- resources/views/auth/forgot-password.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">

            <!-- Logo + Título -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl shadow-2xl mb-8 ring-8 ring-purple-200/50 mx-auto">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2v5h8v-5c0-1.1-.9-2-2-2zM10 8V7a2 2 0 114 0v1"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18 21H6a2 2 0 01-2-2V10a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h1 class="text-5xl font-black text-gray-900 mb-3">
                    ¿Olvidaste tu contraseña?
                </h1>
                <p class="text-xl text-gray-600 max-w-sm mx-auto">
                    No te preocupes. Te enviaremos un enlace para crear una nueva en segundos.
                </p>
            </div>

            <!-- Card Premium -->
            <div class="bg-white/80 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
                <div class="p-8 lg:p-10">

                    <!-- Mensaje de éxito (si ya se envió el correo) -->
                    <x-auth-session-status class="mb-6 text-center" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email con icono -->
                        <div class="mb-8">
                            <x-input-label for="email" :value="__('Correo universitario')" class="font-semibold text-gray-700"/>

                            <div class="relative">
                                <x-text-input id="email"
                                              class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm pl-12 pr-4"
                                              type="email"
                                              name="email"
                                              :value="old('email')"
                                              required
                                              autofocus
                                              autocomplete="email"
                                              inputmode="email"
                                              placeholder="juan@itesm.mx"/>

                                <!-- Icono de correo -->
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                            </div>

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Botón principal con efecto wow -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-xl py-5 rounded-2xl shadow-2xl hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-4 group">
                            Enviar enlace de recuperación
                            <svg class="w-7 h-7 group-hover:translate-x-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>

                        <!-- Volver al login -->
                        <div class="mt-8 text-center">
                            <a href="{{ route('login') }}"
                               class="inline-flex items-center gap-2 text-purple-600 hover:text-purple-700 font-bold text-lg hover:underline transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al inicio de sesión
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Footer confianza -->
                <div class="bg-gradient-to-r from-purple-600/10 to-pink-600/10 px-8 py-6 text-center">
                    <p class="text-gray-700 font-medium">
                        Tus datos están protegidos con cifrado de grado militar
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>