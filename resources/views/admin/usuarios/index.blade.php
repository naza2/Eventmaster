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
                        <p class="text-5xl font-black text-indigo-600 mt-3">{{ $usuarios->total() }}</p>
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
                        <p class="text-5xl font-black text-purple-600 mt-3">{{ \App\Models\User::role('administrador')->count() }}</p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill-current" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-bold">Estudiantes</p>
                        <p class="text-5xl font-black text-emerald-600 mt-3">{{ \App\Models\User::role('estudiante')->count() }}</p>
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
                        <p class="text-gray-600 text-sm font-bold">Hoy</p>
                        <p class="text-5xl font-black text-amber-600 mt-3">{{ \App\Models\User::whereDate('created_at', today())->count() }}</p>
                    </div>
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-500 to-orange-600 rounded-3xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón volver + búsqueda -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-3 text-indigo-600 hover:text-indigo-700 font-bold text-lg hover:underline transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Panel
            </a>

            <div class="relative max-w-md w-full">
                <input type="text" placeholder="Buscar por nombre, email o matrícula..."
                       class="w-full pl-14 pr-6 py-4 rounded-3xl border border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-lg transition"
                       x-data @input.debounce="console.log('buscar:', $event.target.value)">
                <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>

        <!-- Tabla Premium con hover cards -->
        <div class="bg-white/80 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
                            <th class="px-8 py-6 text-left font-black text-lg">Usuario</th>
                            <th class="px-8 py-6 text-left font-black text-lg">Email</th>
                            <th class="px-8 py-6 text-left font-black text-lg">Carrera</th>
                            <th class="px-8 py-6 text-left font-black text-lg">Rol</th>
                            <th class="px-8 py-6 text-center font-black text-lg">Equipos</th>
                            <th class="px-8 py-6 text-center font-black text-lg">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($usuarios as $usuario)
                            <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-300 group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">
                                        <img src="{{ $usuario->foto_perfil ? Storage::url($usuario->foto_perfil) : asset('images/avatar.svg') }}"
                                             alt="{{ $usuario->name }}"
                                             class="w-16 h-16 rounded-2xl object-cover ring-4 ring-purple-100 shadow-lg">
                                        <div>
                                            <p class="text-xl font-black text-gray-900">{{ $usuario->name }}</p>
                                            <p class="text-sm text-gray-600 font-medium">{{ $usuario->matricula ?? 'Sin matrícula' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-gray-700 font-medium">{{ $usuario->email }}</td>
                                <td class="px-8 py-6 text-gray-700 font-medium">{{ $usuario->carrera?->nombre ?? '-' }}</td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($usuario->roles as $role)
                                            <span class="px-4 py-2 rounded-full text-white font-bold text-sm shadow-lg
                                                @if($role->name === 'administrador') bg-gradient-to-r from-indigo-600 to-purple-600
                                                @elseif($role->name === 'estudiante') bg-gradient-to-r from-emerald-500 to-teal-600
                                                @else bg-gradient-to-r from-gray-600 to-gray-800 @endif">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @empty
                                            <span class="text-gray-500 italic">Sin rol asignado</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 text-white font-black text-2xl rounded-2xl shadow-xl">
                                        {{ $usuario->participantes()->count() }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.usuarios.show', $usuario) }}"
                                           class="px-5 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold rounded-2xl hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition shadow-lg">
                                            Ver
                                        </a>
                                        <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                           class="px-5 py-3 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold rounded-2xl hover:from-amber-600 hover:to-orange-700 transform hover:scale-105 transition shadow-lg">
                                            Editar
                                        </a>
                                        <button type="button"
                                                onclick="confirmDelete({{ $usuario->id }}, '{{ $usuario->name }}')"
                                                class="px-5 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white font-bold rounded-2xl hover:from-red-600 hover:to-rose-700 transform hover:scale-105 transition shadow-lg">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-20 text-center">
                                    <div class="text-gray-500 text-xl font-medium">
                                        No hay usuarios encontrados
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación Premium -->
            <div class="px-8 py-6 border-t border-gray-200 bg-white/50 backdrop-blur">
                {{ $usuarios->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</div>

<!-- Script para confirmación de eliminación (opcional, más bonito) -->
<script>
function confirmDelete(id, name) {
    if (confirm(`¿Estás 100% seguro de eliminar a "${name}"?`)) {
        document.getElementById(`delete-form-${id}`).submit();
    }
}
</script>

@foreach($usuarios as $usuario)
<form id="delete-form-{{ $usuario->id }}" action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endforeach
@endsection