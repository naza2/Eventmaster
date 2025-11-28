{{-- resources/views/landing/inicio.blade.php --}}
<section id="section-inicio" class="min-h-screen">
    <div class="relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Gestiona tus eventos</span>
                            <span class="block text-purple-600">académicos</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            La plataforma perfecta para organizar, participar y ganar en competencias académicas con equipos multidisciplinarios.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <button onclick="showModal('registerModal')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg md:px-10 transition">
                                    Comenzar ahora
                                </button>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <button onclick="showModal('loginModal')" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-700 bg-gray-100 hover:bg-gray-200 md:py-4 md:text-lg md:px-10 transition">
                                    Iniciar Sesión
                                </button>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        {{-- Imagen hero (la que tenías con logo.jpeg) --}}
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <div class="h-56 w-full sm:h-72 md:h-96 lg:w-full lg:h-full">
                <div class="w-full h-full flex items-center justify-center p-8">
                    <div class="bg-white rounded-2xl shadow-2xl p-6">
                        <img 
                            src="{{ asset('img/logo.jpeg') }}" 
                            alt="Dashboard EventMaster" 
                            class="w-full h-auto rounded-lg shadow-lg"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sección de características --}}
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Características principales
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Todo lo que necesitas para gestionar eventos académicos exitosos
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="bg-gray-50 p-6 rounded-xl hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Gestión de Eventos</h3>
                    <p class="text-gray-600">Crea y organiza eventos académicos de manera sencilla y eficiente.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Equipos Multidisciplinarios</h3>
                    <p class="text-gray-600">Forma equipos con estudiantes de diferentes carreras y especialidades.</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-trophy text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Seguimiento de Progreso</h3>
                    <p class="text-gray-600">Monitorea el avance de los proyectos y genera constancias automáticas.</p>
                </div>
            </div>
        </div>
    </div>
</section>