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
<!-- BANNER DE CELEBRACIÓN SI ES GANADOR -->
@if($esGanador)
    <div class="bg-gradient-to-r from-yellow-400 via-orange-500 to-pink-500 py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-center gap-6 text-white">
                <div class="text-6xl animate-bounce">🏆</div>
                <div class="text-center">
                    <h2 class="text-4xl font-black mb-2">
                        ¡FELICIDADES! Lugar #{{ $esGanador->posicion }}
                    </h2>
                    <p class="text-xl font-bold">
                        @if($esGanador->posicion == 1)
                            🥇 Primer Lugar
                        @elseif($esGanador->posicion == 2)
                            🥈 Segundo Lugar
                        @elseif($esGanador->posicion == 3)
                            🥉 Tercer Lugar
                        @endif
                    </p>
                    @if($esGanador->premio)
                        <p class="text-lg mt-2">🎁 Premio: {{ $esGanador->premio }}</p>
                    @endif
                </div>
                <div class="text-6xl animate-bounce">🎉</div>
            </div>
        </div>
    </div>
@endif


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
                        @if($equipo->evento->estado !== 'finalizado')
                            @can('invite', $equipo)
                                <a href="{{ route('equipos.invitar', $equipo) }}" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                    + Invitar miembro
                                </a>
                            @endcan
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($equipo->participantes as $miembro)
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 hover:shadow-2xl transition-all duration-300 border border-gray-200">
                                <div class="flex items-start gap-6">
                                    <img src="{{ $miembro->user->foto_perfil ? Storage::url($miembro->user->foto_perfil) : asset('images/avatar.png') }}"
                                         alt="{{ $miembro->user->name }}"
                                         class="w-24 h-24 rounded-2xl object-cover ring-4 ring-white shadow-xl">

                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-3">
                                            <h3 class="text-2xl font-black text-gray-900">{{ $miembro->user->name }}</h3>
                                            @if($miembro->es_lider)
                                                <span class="px-4 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold rounded-full">LÍDER</span>
                                            @endif
                                        </div>
                                        
                                        <div class="space-y-2 mb-4">
                                            <p class="text-indigo-600 font-bold text-lg">
                                                {{ ucfirst(str_replace('_', ' ', $miembro->rol)) }}
                                            </p>
                                            <p class="text-gray-700 font-medium">
                                                {{ $miembro->user->carrera?->nombre ?? 'Sin carrera' }}
                                            </p>
                                        </div>

                                        <div class="space-y-1 text-sm">
                                            @if($miembro->user->matricula)
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                                    </svg>
                                                    <span>{{ $miembro->user->matricula }}</span>
                                                </div>
                                            @endif
                                            
                                            @if($miembro->user->email)
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span class="truncate">{{ $miembro->user->email }}</span>
                                                </div>
                                            @endif

                                            @if($miembro->user->telefono)
                                                <div class="flex items-center gap-2 text-gray-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                    <span>{{ $miembro->user->telefono }}</span>
                                                </div>
                                            @endif
                                        </div>
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
                        @if($equipo->evento->estado !== 'finalizado')
                            @can('update', $equipo)
                                <button @click="open = true"
                                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                    + Publicar avance
                                </button>
                            @endcan
                        @endif
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

                <!-- CALIFICACIONES -->
                @if($equipo->calificaciones->count() > 0 || $promedioCalificacion)
                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl shadow-xl p-8 border-2 border-purple-200">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Calificaciones</h3>

                        @if($promedioCalificacion)
                            <div class="text-center mb-6 pb-6 border-b-2 border-purple-200">
                                <p class="text-sm text-gray-600 font-bold uppercase mb-2">Promedio General</p>
                                <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">
                                    {{ number_format($promedioCalificacion, 1) }}
                                </p>
                                <p class="text-gray-500 text-sm mt-1">de 100 puntos</p>
                            </div>
                        @endif

                        @if($equipo->calificaciones->count() > 0)
                            <div class="space-y-3">
                                <p class="text-sm text-gray-600 font-bold uppercase mb-3">Por criterio:</p>
                                @foreach($equipo->calificaciones->groupBy('criterio.nombre') as $criterio => $calificaciones)
                                    <div class="bg-white rounded-xl p-4">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-bold text-gray-700">{{ $criterio }}</p>
                                            <p class="text-2xl font-black text-purple-600">
                                                {{ number_format($calificaciones->avg('puntuacion'), 1) }}
                                            </p>
                                        </div>
                                        <div class="mt-2 bg-gray-200 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-full h-2"
                                                 style="width: {{ ($calificaciones->avg('puntuacion') / 100) * 100 }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif


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
                        @if($equipo->evento->estado !== 'finalizado')
                            @can('update', $equipo)
                                <button class="mt-6 w-full px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:shadow-xl transition">
                                    Solicitar asesor
                                </button>
                            @endcan
                        @endif
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