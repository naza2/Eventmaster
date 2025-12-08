<x-guest-layout>
<<<<<<< HEAD
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">

            <!-- Logo + Título -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl shadow-2xl mb-8 ring-8 ring-purple-200/50 mx-auto">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h1 class="text-5xl font-black text-gray-900 mb-3">
                    ¡Hola de nuevo!
                </h1>
                <p class="text-xl text-gray-600">Ingresa para seguir compitiendo</p>
            </div>

            <!-- Card Premium -->
            <div class="bg-white/80 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
                <div class="p-8 lg:p-10">

                    <!-- Mensaje de sesión -->
                    <x-auth-session-status class="mb-6 text-center" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email con icono -->
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Correo universitario')" class="font-semibold text-gray-700"/>
                            <div class="relative">
                                <x-text-input id="email"
                                              class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm pl-12"
                                              type="email"
                                              name="email"
                                              :value="old('email')"
                                              required
                                              autofocus
                                              autocomplete="username"
                                              placeholder="juan@itesm.mx"/>

                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Contraseña SIN ojo (limpio y simple) -->
                        <div class="mb-6">
                            <x-input-label for="password" :value="__('Contraseña')" class="font-semibold text-gray-700"/>
                            <div class="relative">
                                <x-text-input id="password"
                                              type="password"
                                              class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm pl-12"
                                              name="password"
                                              required
                                              autocomplete="current-password"
                                              placeholder="••••••••"/>

                                <!-- Solo icono de candado -->
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2v5h8v-5c0-1.1-.9-2-2-2zM10 8V7a2 2 0 114 0v1"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M18 21H6a2 2 0 01-2-2V10a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Recordarme + Olvidé contraseña -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                                <input id="remember_me" type="checkbox"
                                       class="h-5 w-5 text-purple-600 rounded focus:ring-purple-500 border-gray-300 shadow-sm"
                                       name="remember">
                                <span class="ml-3 text-gray-700 font-medium">Mantener sesión abierta</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-purple-600 hover:text-purple-700 font-bold text-sm hover:underline transition">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <!-- Botón principal -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-xl py-5 rounded-2xl shadow-2xl hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group">
                            Iniciar Sesión
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <!-- Registro -->
                        <div class="mt-8 text-center">
                            <p class="text-gray-600 text-lg">
                                ¿Primera vez aquí? 
                                <a href="{{ route('register') }}" 
                                   class="font-black text-purple-600 hover:text-purple-700 hover:underline transition">
                                    Crea tu cuenta gratis
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Footer confianza -->
                <div class="bg-gradient-to-r from-purple-600/10 to-pink-600/10 px-8 py-6 text-center">
                    <p class="text-gray-700 font-medium">
                        +15,000 estudiantes ya confían en <span class="text-purple-700 font-black">EventMaster</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
=======
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold text-gray-900">Bienvenido de vuelta</h2>
                <p class="mt-2 text-gray-600">Ingresa a tu cuenta para continuar</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-lg border border-gray-100">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-700 font-semibold"/>
                        <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                      type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-semibold"/>
                        <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                      type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Recordarme y Olvidaste contraseña -->
                    <div class="flex items-center justify-between mb-8">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="h-5 w-5 text-purple-600 rounded focus:ring-purple-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-purple-600 hover:text-purple-700 font-semibold" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-full transition shadow-lg text-lg">
                        Iniciar Sesión
                    </button>

                    <!-- No tienes cuenta -->
                    <div class="mt-8 text-center">
                        <span class="text-gray-600">¿No tienes una cuenta? </span>
                        <a href="{{ route('register') }}" class="text-purple-600 font-bold hover:underline">
                            Regístrate aquí
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
