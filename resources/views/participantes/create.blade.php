@extends('layouts.app')

@section('title', 'Invitar miembro a ' . $equipo->nombre_equipo)

@section('content')
<!-- HERO INVITAR MIEMBRO -->
<section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white py-32">
    <div class="absolute inset-0 bg-black/30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-7xl font-black mb-8">
            Invitar nuevo miembro
        </h1>
        <p class="text-2xl md:text-3xl font-light mb-12 max-w-4xl mx-auto opacity-90">
            Agrega a un compañero a <strong class="text-yellow-300">{{ $equipo->nombre_equipo }}</strong>
        </p>

        <div class="inline-flex items-center gap-4 bg-white/20 backdrop-blur px-8 py-6 rounded-full">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span class="text-xl font-bold">
                {{ $equipo->participantes_count }} / {{ $equipo->evento->max_miembros }} miembros actuales
            </span>
        </div>
    </div>
</section>

<!-- FORMULARIO DE INVITACIÓN -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-10 text-white">
                <h2 class="text-4xl font-black mb-4">¡Crece tu equipo!</h2>
                <p class="text-xl opacity-90">
                    Invita a un compañero por su <strong>matrícula</strong> o <strong>correo institucional</strong>
                </p>
            </div>

            <div class="p-10 lg:p-16">
                <form action="{{ route('miembros.store', $equipo) }}" method="POST" class="space-y-10">
                    @csrf

                    <!-- BUSCAR POR MATRÍCULA O EMAIL -->
                    <div>
                        <label for="buscar" class="block text-xl font-bold text-gray-800 mb-4">
                            Buscar estudiante por matrícula o email *
                        </label>
                        <div class="relative">
                            <input type="text" name="buscar" id="buscar" required
                                   value="{{ old('buscar') }}"
                                   class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                   placeholder="Ej: 2021001234 o juan.perez@universidad.edu.mx"
                                   x-data @input.debounce.500ms="buscarUsuario()">
                            <div class="absolute right-6 top-1/2 -translate-y-1/2">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Resultado de búsqueda -->
                        <div id="resultado-busqueda" class="mt-6 hidden">
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-8 border-2 border-indigo-200">
                                <div class="flex items-center gap-6">
                                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white text-3xl font-black shadow-xl">
                                        <span x-text="usuarioEncontrado?.name?.charAt(0).toUpperCase() || '?'"></span>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900" x-text="usuarioEncontrado?.name || 'Buscando...'"></h3>
                                        <p class="text-indigo-600 font-bold" x-text="usuarioEncontrado?.email"></p>
                                        <p class="text-gray-600" x-text="usuarioEncontrado?.carrera?.nombre || 'Sin carrera'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('buscar')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ROL EN EL EQUIPO -->
                    <div>
                        <label for="rol" class="block text-xl font-bold text-gray-800 mb-4">
                            Rol que desempeñará en el equipo *
                        </label>
                        <select name="rol" id="rol" required
                                class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg">
                            <option value="">Seleccionar rol...</option>
                            <option value="programador">Programador / Desarrollador</option>
                            <option value="diseñador">Diseñador UX/UI</option>
                            <option value="analista_negocios">Analista de Negocios</option>
                            <option value="analista_datos">Analista de Datos / IA</option>
                            <option value="otro">Otro (especificar en descripción)</option>
                        </select>
                        @error('rol')
                            <p class="mt-3 text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- MENSAJE PERSONALIZADO (opcional) -->
                    <div>
                        <label for="mensaje" class="block text-xl font-bold text-gray-800 mb-4">
                            Mensaje personalizado (opcional)
                        </label>
                        <textarea name="mensaje" id="mensaje" rows="4"
                                  class="w-full px-8 py-6 text-lg border-2 border-gray-300 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition shadow-lg"
                                  placeholder="Hola {{ $equipo->nombre_equipo }} necesita un {{ $rol }} talentoso como tú...">{{ old('mensaje') }}</textarea>
                    </div>

                    <!-- INFO DEL EQUIPO ACTUAL -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-10 border border-gray-200">
                        <h3 class="text-2xl font-black text-gray-900 mb-8">Equipo actual ({{ $equipo->participantes_count }}/{{ $equipo->evento->max_miembros }})</h3>
                        <div class="space-y-6">
                            @foreach($equipo->participantes as $miembro)
                                <div class="flex items-center justify-between bg-white rounded-2xl p-6 shadow">
                                    <div class="flex items-center gap-5">
                                        <img src="{{ $miembro->user->foto_perfil ? Storage::url($miembro->user->foto_perfil) : asset('images/avatar.svg') }}"
                                             alt="{{ $miembro->user->name }}"
                                             class="w-16 h-16 rounded-2xl object-cover ring-4 ring-white shadow-xl">
                                        <div>
                                            <p class="text-xl font-black text-gray-900">{{ $miembro->user->name }}</p>
                                            <p class="text-indigo-600 font-bold">{{ ucfirst(str_replace('_', ' ', $miembro->rol)) }}</p>
                                        </div>
                                    </div>
                                    @if($miembro->es_lider)
                                        <span class="px-4 py-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white font-bold rounded-full">LÍDER</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center pt-12">
                        <a href="{{ route('equipos.show', $equipo) }}"
                           class="px-12 py-5 bg-gray-200 text-gray-800 font-bold text-xl rounded-2xl hover:bg-gray-300 transition text-center">
                            ← Volver al equipo
                        </a>
                        <button type="submit"
                                class="px-16 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-black text-2xl rounded-3xl hover:shadow-2xl hover:shadow-green-500/30 transform hover:scale-105 transition-all duration-500 shadow-xl">
                            Enviar invitación
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- SCRIPT BUSCADOR EN TIEMPO REAL (opcional, muy pro) -->
<script>
function buscarUsuario() {
    const query = document.getElementById('buscar').value;
    const resultado = document.getElementById('resultado-busqueda');

    if (query.length < 3) {
        resultado.classList.add('hidden');
        return;
    }

    // Aquí puedes hacer una petición AJAX a una ruta que busque usuarios
    // Ejemplo con fetch:
    // fetch(`/api/buscar-usuario?q=${query}`)
    //     .then(r => r.json())
    //     .then(data => {
    //         if (data.user) {
    //             document.querySelector('[x-text="usuarioEncontrado?.name"]').textContent = data.user.name;
    //             document.querySelector('[x-text="usuarioEncontrado?.email"]').textContent = data.user.email;
    //             document.querySelector('[x-text="usuarioEncontrado?.carrera?.nombre"]').textContent = data.user.carrera?.nombre || 'Sin carrera';
    //             resultado.classList.remove('hidden');
    //         }
    //     });
}
</script>
@endsection