@extends('layouts.master')

@section('title', 'Editar Usuario')

@section('content')
<section class="py-16">
    <div class="max-w-3xl mx-auto px-6">
        <div class="mb-8">
            <a href="{{ route('admin.usuarios.show', $usuario) }}" class="text-indigo-600 hover:text-indigo-700 font-bold">
                ← Volver al usuario
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-xl p-10">
            <h1 class="text-3xl font-black text-gray-900 mb-8">Editar: {{ $usuario->name }}</h1>

            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <input type="hidden" name="tab" value="{{ request()->query('tab') }}">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="name" value="{{ old('name', $usuario->name) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-4">Roles</label>
                    <div class="space-y-3">
                        @foreach($roles as $role)
                            <div class="flex items-center">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                       @if($usuario->hasRole($role->name)) checked @endif
                                       class="w-5 h-5 rounded border-gray-300 cursor-pointer" id="role_{{ $role->id }}">
                                <label for="role_{{ $role->id }}" class="ml-3 cursor-pointer">
                                    <span class="font-bold text-gray-900">{{ ucfirst($role->name) }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-200 flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                        Guardar cambios
                    </button>
                    <a href="{{ route('admin.usuarios.show', $usuario) }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
