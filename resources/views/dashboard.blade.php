<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenido, {{ auth()->user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h3 class="text-2xl font-bold text-purple-600 mb-6">Tu Dashboard EventMaster</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-700 text-white p-6 rounded-xl">
                        <h4 class="text-4xl font-bold">12</h4>
                        <p>Eventos activos</p>
                    </div>
                    <div class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-6 rounded-xl">
                        <h4 class="text-4xl font-bold">3</h4>
                        <p>Equipos creados</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-500 to-green-700 text-white p-6 rounded-xl">
                        <h4 class="text-4xl font-bold">2</h4>
                        <p>Constancias ganadas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>