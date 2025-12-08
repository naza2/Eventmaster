<x-guest-layout>
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
