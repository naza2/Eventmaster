{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-lg">
            <!-- Logo + Título -->
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl shadow-2xl mb-8 ring-8 ring-purple-200/50">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h1 class="text-5xl font-black text-gray-900 mb-3">
                    ¡Únete a <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">EventMaster</span>!
                </h1>
                <p class="text-xl text-gray-600">Crea tu cuenta en segundos y empieza a ganar competencias</p>
            </div>

            <!-- Card con glassmorphism -->
            <div class="bg-white/80 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
                <div class="p-8 lg:p-10">
                    <form method="POST" action="{{ route('register') }}" x-data="{ showPassword: false }">
                        @csrf

                        <!-- Nombre y Apellido -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="name" :value="__('Nombre')" class="font-semibold text-gray-700"/>
                                <x-text-input id="name"
                                              class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                                              type="text"
                                              name="name"
                                              :value="old('name')"
                                              required
                                              autofocus
                                              autocomplete="given-name"
                                              placeholder="Juan"/>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="lastname" :value="__('Apellido')" class="font-semibold text-gray-700"/>
                                <x-text-input id="lastname"
                                              class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                                              type="text"
                                              name="lastname"
                                              :value="old('lastname')"
                                              required
                                              autocomplete="family-name"
                                              placeholder="Pérez"/>
                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                            </div>
                        </div>
                         <!-- Carrera y Matrícula -->
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
      <div>
          <x-input-label for="carrera_id" :value="__('Carrera')"
  class="font-semibold text-gray-700"/>
          <select id="carrera_id" name="carrera_id" required
                  class="mt-2 w-full rounded-2xl border-gray-300
  focus:border-purple-500 focus:ring-purple-500 shadow-sm">
              <option value="">Selecciona tu carrera</option>
              @foreach($carreras as $carrera)
                  <option value="{{ $carrera->id }}" {{
  old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                      {{ $carrera->nombre }}
                  </option>
              @endforeach
          </select>
          <x-input-error :messages="$errors->get('carrera_id')"
  class="mt-2" />
      </div>

      <div>
          <x-input-label for="matricula" :value="__('Número de
  Control')" class="font-semibold text-gray-700"/>
          <x-text-input id="matricula" type="text" name="matricula"
  :value="old('matricula')" required
                        class="mt-2 w-full rounded-2xl border-gray-300
  focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                        placeholder="20181234"/>
          <x-input-error :messages="$errors->get('matricula')"
  class="mt-2" />
      </div>
  </div>

                        <!-- Correo universitario con validación estricta -->
                        <div class="mb-6">
                            <x-input-label for="email" :value="__('Correo universitario')" class="font-semibold text-gray-700"/>

                            <x-text-input id="email"
                                        class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                                        type="email"
                                        name="email"
                                        :value="old('email')"
                                        required
                                        autocomplete="email"
                                        inputmode="email"
                                        placeholder="juan.perez@university.edu.mx"
                                        pattern="[a-zA-Z0-9._%+-]+@(edu|ac|tec|itesm|unam|ipn|uanl|udg|iteso|upaep|udlap|itesa|utch|uvm|unedl|univa|up|anahuac|ibero|lasalle|udem|tec\.mx|itesm\.mx|unam\.mx|ipn\.mx)+\.[a-zA-Z]{2,}$"
                                        title="Ingresa un correo institucional válido (ej: .edu, .mx, .ac, etc.)"/>

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Contraseña con validación en tiempo real -->
<div class="mb-6">
    <x-input-label for="password" :value="__('Contraseña')" class="font-semibold text-gray-700"/>

    <div x-data="passwordStrength()" x-init="watchPassword">
        <div class="relative">
            <x-text-input id="password"
                          type="password"
                          class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm pr-12"
                          name="password"
                          required
                          autocomplete="new-password"
                          placeholder="Mínimo 8 caracteres"
                          x-ref="passwordInput"
                          @input="checkStrength($event.target.value)"/>
        </div>

        <!-- Barra de fuerza + mensaje -->
        <div class="mt-3">
            <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                <div x-show="strength > 0"
                     class="h-full transition-all duration-300 rounded-full"
                     :class="{
                         'w-1/4 bg-red-500': strength === 1,
                         'w-2/4 bg-orange-500': strength === 2,
                         'w-3/4 bg-yellow-500': strength === 3,
                         'w-full bg-green-500': strength >= 4
                     }"></div>
            </div>

            <p class="mt-2 text-sm" :class="{
                'text-red-600': strength === 1,
                'text-orange-600': strength === 2,
                'text-yellow-600': strength === 3,
                'text-green-600 font-bold': strength >= 4,
                'text-gray-500': strength === 0
            }" x-text="message"></p>
        </div>
    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Alpine.js para validar fuerza de contraseña -->
<script>
function passwordStrength() {
    return {
        strength: 0,
        message: 'Escribe tu contraseña',
        showPassword: false,

        checkStrength(password) {
            let score = 0;
            this.message = '';

            if (!password) {
                this.strength = 0;
                this.message = 'Escribe tu contraseña';
                return;
            }

            if (password.length >= 8) score++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            this.strength = score;

            if (score <= 1) this.message = 'Muy débil';
            else if (score === 2) this.message = 'Débil';
            else if (score === 3) this.message = 'Regular';
            else this.message = 'Fuerte';
        },

        watchPassword() {
            this.$watch('$refs.passwordInput.value', value => this.checkStrength(value));
        }
    }
}
</script>


                        <!-- Confirmar contraseña -->
                        <div class="mb-8">
                            <x-input-label for="password_confirmation" :value="__('Confirmar contraseña')" class="font-semibold text-gray-700"/>
                            <x-text-input id="password_confirmation"
                                          class="mt-2 w-full rounded-2xl border-gray-300 focus:border-purple-500 focus:ring-purple-500 shadow-sm"
                                          type="password"
                                          name="password_confirmation"
                                          required
                                          autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Términos con enlace real -->
                        <div class="mb-8 flex items-start">
                            <input type="checkbox"
                                   id="terms"
                                   name="terms"
                                   required
                                   class="mt-1 h-5 w-5 text-purple-600 rounded-lg focus:ring-purple-500 border-gray-300 shadow-sm">
                            <label for="terms" class="ml-3 text-sm text-gray-600 leading-relaxed">
                                Acepto los
                                <a href="#" class="text-purple-600 font-bold hover:underline">Términos de Servicio</a> y la
                                <a href="#" class="text-purple-600 font-bold hover:underline">Política de Privacidad</a>
                            </label>
                        </div>

                        <!-- Botón principal con efecto premium -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-black text-xl py-5 rounded-2xl shadow-2xl hover:shadow-purple-500/50 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group">
                            Crear mi cuenta gratis
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>

                        <!-- Login link -->
                        <div class="mt-8 text-center">
                            <p class="text-gray-600">
                                ¿Ya tienes cuenta?
                                <a href="{{ route('login') }}"
                                   class="font-bold text-purple-600 hover:text-purple-700 hover:underline transition">
                                    Inicia sesión aquí
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Footer decorativo -->
                <div class="bg-gradient-to-r from-purple-600/10 to-pink-600/10 px-8 py-6 text-center">
                    <p class="text-gray-600 text-sm">
                        Más de <span class="font-bold text-purple-700">15,000 estudiantes</span> ya compiten con EventMaster
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
