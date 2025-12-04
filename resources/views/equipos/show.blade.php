@extends('layouts.master')

@section('title', $equipo->nombre_equipo)

@section('content')
<!-- HERO DEL EQUIPO -->
<section class="relative h-96 overflow-hidden">
    <div class="absolute inset-0">
        @if($equipo->evento->banner)
            <img src="{{ Storage::url($equipo->evento->banner) }}" alt="{{ $equipo->evento->nombre }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-indigo-600 via-purple-700 to-pink-600"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent pointer-events-none"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 h-full flex items-end pb-16">
        <div class="flex items-end gap-10">
            <!-- Logo del equipo -->
            <div class="relative">
                @if($equipo->logo)
                    <img src="{{ Storage::url($equipo->logo) }}" alt="{{ $equipo->nombre_equipo }}" class="w-40 h-40 rounded-3xl object-cover ring-8 ring-white/30 shadow-2xl">
                @else
                    <div class="w-40 h-40 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl flex items-center justify-center text-white text-6xl font-black ring-8 ring-white/30 shadow-2xl">
                        {{ Str::upper(substr($equipo->nombre_equipo, 0, 2)) }}
                    </div>
                @endif

                <!-- Estado del equipo -->
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2">
                    <span class="px-6 py-3 rounded-full font-bold text-white shadow-2xl text-lg
                        @if($equipo->estado === 'aprobado') bg-green-500
                        @elseif($equipo->estado === 'pendiente') bg-yellow-500
                        @else bg-red-600 @endif">
                        {{ ucfirst($equipo->estado) }}
                    </span>
                </div>
            </div>

           

            <div class="text-white">
                <h1 class="text-5xl md:text-7xl font-black mb-4">
                    {{ $equipo->nombre_equipo }}
                </h1>
                <p class="text-3xl font-light mb-6 opacity-90">
                    <p class="text-3xl font-light mb-6 opacity-90">
                    {{ $equipo->nombre_proyecto }}
                </p>

                <div class="flex flex-wrap items-center gap-8 text-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $equipo->evento->nombre }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>{{ $equipo->participantes_count ?? 0 }} / {{ $equipo->evento->max_miembros }} miembros</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- DASHBOARD DEL EQUIPO -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <!-- NAVEGACIÓN RÁPIDA -->
        <div class="bg-white rounded-3xl shadow-xl p-6 mb-12">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-6 text-center">
                <a href="#miembros" class="px-6 py-4 bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold rounded-2xl hover:shadow-xl transition">Miembros</a>
                <a href="#proyecto" class="px-6 py-4 bg-white border-2 border-indigo-600 text-indigo-600 font-bold rounded-2xl hover:bg-indigo-50 transition">Proyecto</a>
                <a href="#avances" class="px-6 py-4 bg-white border-2 border-purple-600 text-purple-600 font-bold rounded-2xl hover:bg-purple-50 transition">Avances</a>
                <a href="#repositorio" class="px-6 py-4 bg-white border-2 border-green-600 text-green-600 font-bold rounded-2xl hover:bg-green-50 transition">Repositorio</a>
                <a href="#asesoria" class="px-6 py-4 bg-white border-2 border-orange-600 text-orange-600 font-bold rounded-2xl hover:bg-orange-50 transition">Asesoría</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- COLUMNA PRINCIPAL -->
            <div class="lg:col-span-2 space-y-12">

                <!-- MIEMBROS -->
                <div id="miembros" class="bg-white rounded-3xl shadow-xl p-10">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-4xl font-black text-gray-900">Miembros del equipo</h2>
                        @can('update', $equipo)
                            <a href="#" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                + Invitar miembro
                            </a>
                        @endcan
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($equipo->participantes as $miembro)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-gray-200">
                                <div class="flex items-center gap-6">
                                    <img src="{{ $miembro->user->foto_perfil ? Storage::url($miembro->user->foto_perfil) : asset('images/avatar.png') }}"
                                         alt="{{ $miembro->user->name }}"
                                         class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white shadow-xl">

                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <h3 class="text-2xl font-black text-gray-900">{{ $miembro->user->name }}</h3>
                                            @if($miembro->es_lider)
                                                <span class="px-4 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold rounded-full">LÍDER</span>
                                            @endif
                                        </div>
                                        <p class="text-indigo-600 font-bold">{{ ucfirst(str_replace('_', ' ', $miembro->rol)) }}</p>
                                        <p class="text-gray-600">{{ $miembro->user->carrera?->nombre ?? 'Sin carrera' }}</p>
                                        <p class="text-sm text-gray-500">{{ $miembro->num_control }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- PROYECTO -->
                <div id="proyecto" class="bg-white rounded-3xl shadow-xl p-10">
                    <h2 class="text-4xl font-black text-gray-900 mb-10">Información del proyecto</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            <h3 class="text-xl font-bold text-gray-700 mb-4">Problema que resuelve</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $equipo->proyecto?->problema_resuelto ?? 'Sin definir' }}</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-700 mb-4">Solución propuesta</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $equipo->proyecto?->solucion_propuesta ?? 'Sin definir' }}</p>
                        </div>
                    </div>

                    @if($equipo->proyecto?->repositorio)
                        <div id="repositorio" class="mt-12 pt-12 border-t border-gray-200">
                            <h3 class="text-2xl font-black text-gray-900 mb-8">Repositorio y enlaces</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @if($equipo->proyecto->repositorio?->github)
                                    <a href="{{ $equipo->proyecto->repositorio->github }}" target="_blank"
                                       class="bg-black text-white px-8 py-6 rounded-2xl text-center hover:shadow-2xl transition">
                                        <p class="font-bold text-xl">GitHub</p>
                                    </a>
                                @endif
                                @if($equipo->proyecto->repositorio?->demo)
                                    <a href="{{ $equipo->proyecto->repositorio->demo }}" target="_blank"
                                       class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-6 rounded-2xl text-center hover:shadow-2xl transition">
                                        <p class="font-bold text-xl">Demo</p>
                                    </a>
                                @endif
                                @if($equipo->proyecto->repositorio?->video_pitch)
                                    <a href="{{ $equipo->proyecto->repositorio->video_pitch }}" target="_blank"
                                       class="bg-red-600 text-white px-8 py-6 rounded-2xl text-center hover:shadow-2xl transition">
                                        <p class="font-bold text-xl">Video Pitch</p>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- AVANCES -->
                <div id="avances" class="bg-white rounded-3xl shadow-xl p-10">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-4xl font-black text-gray-900">Avances del proyecto</h2>
                        @can('update', $equipo)
                            <button @click="open = true"
                                    class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                + Publicar avance
                            </button>
                        @endcan
                    </div>

                    @if($equipo->proyecto && $equipo->proyecto->avances()->count() > 0)
                        <div class="space-y-8">
                            @foreach($equipo->proyecto->avances()->orderByDesc('created_at')->get() as $avance)
                                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-2xl font-black text-gray-900">{{ $avance->titulo }}</h3>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Por {{ $avance->user->name }} • {{ $avance->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-4xl font-black text-indigo-600">{{ $avance->porcentaje_avance }}%</p>
                                            <p class="text-sm text-gray-600">Avance</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed mb-6">{{ $avance->descripcion }}</p>

                                    @if($avance->evidencias && count($avance->evidencias) > 0)
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach($avance->evidencias as $file)
                                                <img src="{{ Storage::url($file) }}" alt="Evidencia"
                                                     class="rounded-xl shadow-lg hover:shadow-2xl transition">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-20">
                            <p class="text-2xl text-gray-600">Aún no hay avances publicados</p>
                            <p class="text-lg text-gray-500 mt-4">¡Empieza a documentar tu progreso!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- SIDEBAR DERECHA -->
            <div class="space-y-10">
                <!-- INFORMACIÓN RÁPIDA -->
                <div class="bg-white rounded-3xl shadow-xl p-8">
                    <h3 class="text-2xl font-black text-gray-900 mb-8">Información rápida</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Evento</p>
                            <p class="text-xl font-black text-indigo-600">{{ $equipo->evento->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Estado</p>
                            <p class="text-xl font-black text-purple-600">{{ ucfirst($equipo->estado) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Fecha límite</p>
                            <p class="text-xl font-black text-red-600">
                                {{ $equipo->evento->fecha_fin->format('d/m/Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 font-bold uppercase">Días restantes</p>
                            <p class="text-4xl font-black text-orange-600">
                                {{ now()->diffInDays($equipo->evento->fecha_fin) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ASESORÍA -->
                <div id="asesoria" class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl shadow-xl p-8 border border-blue-100">
                    <h3 class="text-2xl font-black text-gray-900 mb-6">Asesoría técnica</h3>
                    @if($equipo->asesorias->where('aprobado', true)->first())
                        <div class="text-center">
                            <p class="text-lg text-gray-700 mb-4">Tu asesor asignado es:</p>
                            <p class="text-3xl font-black text-indigo-600">
                                {{ $equipo->asesorias->where('aprobado', true)->first()->asesor->name }}
                            </p>
                        </div>
                    @else
                        <p class="text-center text-gray-600">
                            @if($equipo->asesorias->count() > 0)
                                En espera de aprobación...
                            @else
                                No tienes asesor asignado aún
                            @endif
                        </p>
                        @can('update', $equipo)
                            <button class="mt-6 w-full px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                Solicitar asesor
                            </button>
                        @endcan
                    @endif
                </div>

                <!-- PRÓXIMOS PASOS -->
                <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-3xl p-8 text-white">
                    <h3 class="text-2xl font-black mb-6">Próximos pasos</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg">Completar perfil del proyecto</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg">Subir repositorio y demo</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-lg opacity-70">Presentar al jurado</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection