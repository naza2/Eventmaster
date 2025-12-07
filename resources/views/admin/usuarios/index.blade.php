@extends('layouts.master')

@section('title', 'Gestión de Usuarios')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-4xl font-black text-gray-900">Gestión de Usuarios</h1>
            <a href="{{ route('admin.usuarios.create') }}" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-xl shadow-lg transition transform hover:scale-105 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Crear Usuario
            </a>
        </div>

        <!-- Información de paginación -->
        <div class="mb-6 flex items-center justify-between bg-indigo-50 rounded-2xl p-6">
            <div>
                <p class="text-sm text-indigo-600 font-bold">Total de Usuarios</p>
                <p class="text-3xl font-black text-indigo-700">{{ $usuarios->total() }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-indigo-600 font-bold">Página {{ $usuarios->currentPage() }} de {{ $usuarios->lastPage() }}</p>
                <p class="text-lg text-indigo-700 font-bold">Mostrando {{ $usuarios->count() }} de {{ $usuarios->total() }}</p>
            </div>
        </div>

        <!-- Tabla de usuarios -->
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-bold">Usuario</th>
                            <th class="px-6 py-4 text-left font-bold">Email</th>
                            <th class="px-6 py-4 text-left font-bold">Carrera</th>
                            <th class="px-6 py-4 text-left font-bold">Roles</th>
                            <th class="px-6 py-4 text-left font-bold">Equipos</th>
                            <th class="px-6 py-4 text-center font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($usuarios as $usuario)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $usuario->foto_perfil ? Storage::url($usuario->foto_perfil) : asset('images/avatar.svg') }}" 
                                             alt="{{ $usuario->name }}" class="w-12 h-12 rounded-full object-cover">
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $usuario->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $usuario->matricula ?? 'Sin matrícula' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $usuario->email }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $usuario->carrera?->nombre ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($usuario->roles as $role)
                                            <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-bold rounded-full">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @empty
                                            <span class="text-gray-500 text-sm">Sin roles</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 font-bold rounded-full">
                                        {{ $usuario->participantes()->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.usuarios.show', $usuario) }}" 
                                           class="px-4 py-2 bg-blue-500 text-white font-bold rounded-lg hover:bg-blue-600 transition text-sm">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" 
                                           class="px-4 py-2 bg-yellow-500 text-white font-bold rounded-lg hover:bg-yellow-600 transition text-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline" 
                                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition text-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-600">
                                    No hay usuarios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
