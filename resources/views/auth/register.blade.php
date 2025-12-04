{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <div class="text-center mb-10 text-center">
                <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-gray-900">Crea tu cuenta</h2>
                <p class="mt-2 text-gray-600">Únete a la comunidad EventMaster</p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-lg border border-gray-100">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre y Apellido en dos columnas -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" class="text-gray-700 font-medium"/>
                            <x-text-input id="name" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                          type="text" name="name" :value="old('name')" required autofocus autocomplete="given-name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="lastname" :value="__('Apellido')" class="text-gray-700 font-medium"/>
                            <x-text-input id="lastname" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                          type="text" name="lastname" :value="old('lastname')" required autocomplete="family-name" />
                            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Correo electrónico')" class="text-gray-700 font-medium"/>
                        <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                      type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 font-medium"/>
                        <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                      type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="mb-8">
                        <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="text-gray-700 font-medium"/>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500"
                                      type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Términos -->
                    <div class="mb-8 flex items-center">
                        <input type="checkbox" id="terms" name="terms" required class="h-5 w-5 text-purple-600 rounded focus:ring-purple-500">
                        <label for="terms" class="ml-3 text-sm text-gray-600">
                            Acepto los términos y condiciones
                        </label>
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 rounded-full transition shadow-lg text-lg">
                        Crear Cuenta
                    </button>

                    <!-- Ya tienes cuenta -->
                    <div class="mt-8 text-center">
                        <span class="text-gray-600">¿Ya tienes una cuenta? </span>
                        <a href="{{ route('login') }}" class="text-purple-600 font-bold hover:underline">
                            Inicia sesión aquí
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>