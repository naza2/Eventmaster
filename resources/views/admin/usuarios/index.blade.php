{{-- resources/views/admin/usuarios/index.blade.php --}}
@extends('layouts.master')

@section('title', 'Gestión de Usuarios - Admin')

@section('content')
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
                        <p class="text-5xl font-black text-emerald-600 mt-3">{{ \App\Models\User::role('participante')->count() }}</p>
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
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-3 text-indigo-600 hover:text-indigo-700 font-bold text-lg hover:underline transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver al Panel
            </a>
        </div>

<livewire:admin.usuario-search />

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