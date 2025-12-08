<<<<<<< HEAD
{{-- resources/views/admin/usuarios/index.blade.php --}}
@extends('layouts.master')

@section('title', 'Gestión de Usuarios - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-16">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Header Premium -->
        <div class="text-center mb-16">
            <h1 class="text-7xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 mb-6">
                Gestión de Usuarios
            </h1>
            <p class="text-2xl text-gray-700 font-medium">
                Administra todos los perfiles de la plataforma con control total
            </p>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Total usuarios</p>
                        <p class="text-5xl font-black text-indigo-600 mt-3">{{ \App\Models\User::count() }}</p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Administradores</p>
                        <p class="text-5xl font-black text-purple-600 mt-3">
                            {{ \App\Models\User::role('administrador')->count() }}
                        </p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Estudiantes</p>
                        <p class="text-5xl font-black text-emerald-600 mt-3">
                            {{ \App\Models\User::role('participante')->count() }}
                        </p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422A12.083 12.083 0 0112 21.5c-2.4 0-4.6-.7-6.5-2.1L12 14z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Nuevos hoy</p>
                        <p class="text-5xl font-black text-amber-600 mt-3">
                            {{ \App\Models\User::whereDate('created_at', today())->count() }}
                        </p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones rápidas: Volver + Agregar Usuario -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-4 px-8 py-5 bg-white/90 backdrop-blur-xl text-indigo-600 font-black text-xl rounded-3xl hover:bg-indigo-50 transition transform hover:-translate-x-2 shadow-2xl">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Panel
            </a>

            <!-- Botón Agregar Usuario -->
            <a href="{{ route('admin.usuarios.create') }}"
               class="inline-flex items-center gap-4 px-10 py-5 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-black text-xl rounded-3xl shadow-2xl hover:shadow-emerald-500/50 transform hover:scale-105 transition-all duration-300 group">
                <svg class="w-8 h-8 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Nuevo Usuario
            </a>
        </div>
    </div>
    <!-- Componente Livewire con búsqueda + tabla + paginación de 4 por página -->
        <livewire:admin.usuario-search />
</div>
@endsection
=======
@extends('layouts.master')

@section('title', 'Gestión de Usuarios')

@section('content')
<section class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-4xl font-black text-gray-900">Gestión de Usuarios</h1>
            <a href="{{ route('admin.usuarios.index') }}" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700">
                ← Volver
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
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
