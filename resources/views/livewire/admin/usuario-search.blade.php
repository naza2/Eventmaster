{{-- resources/views/livewire/admin/usuario-search.blade.php --}}
<div>
    <!-- Buscador Premium -->
    <div class="relative max-w-2xl mx-auto mb-12">
        <input type="text"
               wire:model.live.debounce.500ms="search"
               placeholder="Buscar por nombre, email o matrícula..."
               class="w-full pl-16 pr-8 py-5 text-lg rounded-3xl border-2 border-gray-200 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 shadow-xl transition-all duration-300 focus:outline-none"
               autocomplete="off">

        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>

        <!-- Indicador de carga -->
        <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-6 flex items-center">
            <div class="w-6 h-6 border-4 border-purple-600 border-t-transparent rounded-full animate-spin"></div>
        </div>
    </div>

    <!-- Resultados -->
    <div class="bg-white/80 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
                        <th class="px-8 py-6 text-left font-black text-lg">Usuario</th>
                        <th class="px-8 py-6 text-left font-black text-lg">Email</th>
                        <th class="px-8 py-6 text-left font-black text-lg">Matrícula</th>
                        <th class="px-8 py-6 text-left font-black text-lg">Rol</th>
                        <th class="px-8 py-6 text-center font-black text-lg">Equipos</th>
                        <th class="px-8 py-6 text-center font-black text-lg">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($usuarios as $usuario)
                        <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-5">
                                    {{-- AQUÍ ESTÁ LA CLAVE: Detecta si es URL o archivo local --}}
                                    <img src="{{ 
                                        $usuario->foto_perfil 
                                            ? (filter_var($usuario->foto_perfil, FILTER_VALIDATE_URL) 
                                                ? $usuario->foto_perfil 
                                                : Storage::url($usuario->foto_perfil))
                                            : asset('images/avatar.svg') 
                                    }}"
                                         alt="{{ $usuario->name }}"
                                         class="w-16 h-16 rounded-2xl object-cover ring-4 ring-purple-100 shadow-lg">

                                    <div>
                                        <p class="text-xl font-black text-gray-900">{{ $usuario->name }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-8 py-6 text-gray-700 font-medium">{{ $usuario->email }}</td>

                            <td class="px-8 py-6 text-gray-700 font-medium">
                                {{ $usuario->matricula ?? '-' }}
                            </td>

                            <td class="px-8 py-6">
                                <div class="flex flex-wrap gap-2">
                                    @forelse($usuario->roles as $role)
                                        <span class="px-4 py-2 rounded-full text-white font-bold text-sm shadow-lg
                                            {{ $role->name === 'administrador' 
                                                ? 'bg-gradient-to-r from-indigo-600 to-purple-600' 
                                                : 'bg-gradient-to-r from-emerald-500 to-teal-600' }}">
                                            {{ ucfirst($role->name)}}
                                        </span>
                                    @empty
                                        <span class="text-gray-500 italic">Sin rol</span>
                                    @endforelse
                                </div>
                            </td>

                            <td class="px-8 py-6 text-center">
                                <span class="inline-block px-5 py-3 bg-gradient-to-br from-purple-500 to-pink-600 text-white font-black text-2xl rounded-2xl shadow-xl">
                                    {{ $usuario->participantes()->count() }}
                                </span>
                            </td>

                            <td class="px-8 py-6 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('admin.usuarios.show', $usuario) }}"
                                       class="px-5 py-3 bg-blue-600 text-white font-bold rounded-2xl hover:bg-blue-700 transform hover:scale-105 transition shadow-lg">
                                        Ver
                                    </a>
                                    <a href="{{ route('admin.usuarios.edit', $usuario) }}"
                                       class="px-5 py-3 bg-amber-500 text-white font-bold rounded-2xl hover:bg-amber-600 transform hover:scale-105 transition shadow-lg">
                                        Editar
                                    </a>
                                    <button type="button"
                                            onclick="confirm('¿Eliminar a {{ $usuario->name }}?') && document.getElementById('delete-{{ $usuario->id }}').submit()"
                                            class="px-5 py-3 bg-red-600 text-white font-bold rounded-2xl hover:bg-red-700 transform hover:scale-105 transition shadow-lg">
                                        Eliminar
                                    </button>
                                </div>

                                <!-- Formulario oculto para DELETE -->
                                <form id="delete-{{ $usuario->id }}"
                                      action="{{ route('admin.usuarios.destroy', $usuario) }}"
                                      method="POST"
                                      class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="text-gray-500 text-2xl font-bold">
                                    No se encontraron usuarios
                                </div>
                                <p class="text-gray-400 mt-4">
                                    Intenta con otro término de búsqueda
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación Premium -->
        <div class="px-8 py-6 border-t border-gray-200 bg-white/50 backdrop-blur">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <p class="text-gray-700 font-medium">
                    Mostrando <span class="font-black text-purple-600">{{ $usuarios->firstItem() }}</span> 
                    al <span class="font-black text-purple-600">{{ $usuarios->lastItem() }}</span> 
                    de <span class="font-black text-indigo-600">{{ $usuarios->total() }}</span> usuarios
                </p>

                <div>
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
    </div>
</div>