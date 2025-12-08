{{-- resources/views/eventos/index.blade.php --}}
@extends('layouts.master')

@section('title', 'Eventos')

@section('content')
<!-- HERO ÉPICO -->
<section class="relative overflow-hidden py-40">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 opacity-95"></div>
        <div class="absolute inset-0 bg-black opacity-50"></div>

            <div class="relative max-w-7xl mx-auto px-6 text-center text-white">
                <h1 class="text-7xl md:text-9xl font-black mb-8 tracking-tight drop-shadow-2xl">
                    Eventos
                </h1>
                <p class="text-3xl md:text-4xl font-light max-w-5xl mx-auto opacity-95 leading-relaxed">
                    Hackathons, concursos, ferias de proyectos y todo lo que mueve la innovación
                </p>
            </div>
        </div>
    </div>
</section>
<livewire:eventos-search />
@endsection