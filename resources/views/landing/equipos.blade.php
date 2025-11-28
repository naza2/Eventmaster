{{-- resources/views/landing/equipos.blade.php --}}
<section id="section-equipos" class="min-h-screen hidden py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">
                Gestión de Equipos
            </h2>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                Crea tu equipo, invita compañeros, sigue el progreso y genera constancias automáticamente
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-10">

            {{-- COLUMNA IZQUIERDA --}}
            <div class="space-y-10">

                {{-- Crear Nuevo Equipo --}}
                <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-plus-circle text-purple-600 mr-3 text-3xl"></i>
                        Crear Nuevo Equipo
                    </h3>

                    <form id="teamForm" class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre del Equipo</label>
                            <input type="text" required placeholder="Ej: Los Innovadores 2.0"
                                class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Evento</label>
                            <select required class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-4 focus:ring-purple-200 focus:border-purple-500">
                                <option value="" disabled selected>Selecciona un evento</option>
                                <option>Hackathon 2025</option>
                                <option>Data Science Challenge</option>
                                <option>Design Sprint Week</option>
                                <option>Startup Weekend Universitario</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Roles que necesitas</label>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach(['Programador', 'Diseñador', 'Analista de Datos', 'Líder de Proyecto', 'Marketer', 'Presentador'] as $rol)
                                <label class="flex items-center p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-purple-50 transition">
                                    <input type="checkbox" name="roles" value="{{ $rol }}" class="mr-3 text-purple-600 focus:ring-purple-500">
                                    <span class="font-medium">{{ $rol }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:from-purple-700 hover:to-blue-700 transform hover:scale-105 transition">
                            Crear Equipo
                        </button>
                    </form>
                </div>

                {{-- Lista de Alumnos (simulación) --}}
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-graduation-cap text-blue-600 mr-3 text-3xl"></i>
                        Miembros del Equipo
                    </h3>
                    <div id="studentsList" class="space-y-4">
                        <p class="text-center text-gray-500 py-8">Aún no has agregado miembros</p>
                    </div>
                    <button id="openAddStudentBtn" class="w-full mt-6 border-2 border-dashed border-purple-300 text-purple-600 py-4 rounded-xl font-bold hover:border-purple-500 hover:bg-purple-50 transition">
                        <i class="fas fa-user-plus mr-2"></i> Agregar Miembro
                    </button>
                </div>
            </div>

            {{-- COLUMNA DERECHA --}}
            <div class="space-y-10">

                {{-- Progreso de Proyectos --}}
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-chart-line text-green-600 mr-3 text-3xl"></i>
                        Progreso de Equipos
                    </h3>
                    <div id="projectsProgress" class="space-y-6">
                        <div class="text-center py-12 text-gray-500">
                            <i class="fas fa-project-diagram text-6xl mb-4 opacity-20"></i>
                            <p>No hay equipos creados aún</p>
                        </div>
                    </div>
                </div>

                {{-- Constancias Ganadoras --}}
                <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl shadow-xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fas fa-award text-yellow-200 mr-3 text-3xl"></i>
                        Constancias Obtenidas
                    </h3>
                    <div id="certificatesList" class="space-y-4">
                        <p class="text-center py-8 opacity-80">Aún no hay constancias</p>
                    </div>
                    <div class="mt-6 p-5 bg-white bg-opacity-20 rounded-xl backdrop-blur">
                        <p class="text-sm">Las constancias se generan automáticamente al ganar un evento</p>
                    </div>
                </div>

                {{-- Unirse a Equipo Existente --}}
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6">
                        <i class="fas fa-handshake text-white mr-3 text-3xl"></i>
                        Unirse a un Equipo
                    </h3>
                    <div id="joinTeamsList" class="space-y-4">
                        <p class="text-center py-8 opacity-90">No hay equipos buscando miembros</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>