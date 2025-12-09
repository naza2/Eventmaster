@php
    $posiciones = [
        1 => ['emoji' => '🥇', 'texto' => 'Primer Lugar', 'color' => '#FFD700'],
        2 => ['emoji' => '🥈', 'texto' => 'Segundo Lugar', 'color' => '#C0C0C0'],
        3 => ['emoji' => '🥉', 'texto' => 'Tercer Lugar', 'color' => '#CD7F32'],
    ];
    $pos = $posiciones[$ganador->posicion] ?? ['emoji' => '🏆', 'texto' => $ganador->posicion . '° Lugar', 'color' => '#4A90E2'];
@endphp

<x-mail::message>
# {{ $pos['emoji'] }} ¡FELICIDADES, HAN GANADO!

Estimado equipo **{{ $equipo->nombre_equipo }}**,

¡Es con gran alegría que les comunicamos que han obtenido el **{{ $pos['texto'] }}** en **{{ $evento->nombre }}**!

## Detalles del Reconocimiento

- **Equipo:** {{ $equipo->nombre_equipo }}
- **Proyecto:** {{ $equipo->nombre_proyecto }}
- **Posición:** {{ $pos['texto'] }} {{ $pos['emoji'] }}
- **Evento:** {{ $evento->nombre }}
@if($ganador->premio)
- **Premio:** {{ $ganador->premio }}
@endif

@if($ganador->comentario_jurado)
## Comentarios del Jurado

<x-mail::panel>
{{ $ganador->comentario_jurado }}
</x-mail::panel>
@endif

## Descarga tu Constancia

Ya puedes descargar tu constancia de participación oficial haciendo clic en el botón de abajo:

<x-mail::button :url="$urlConstancia" color="success">
Descargar Constancia (PDF)
</x-mail::button>

<x-mail::panel>
🎉 **¡Enhorabuena!** Su dedicación, creatividad y trabajo en equipo han dado frutos excepcionales.
</x-mail::panel>

Les deseamos mucho éxito en sus futuros proyectos.

Con admiración,<br>
Equipo de {{ config('app.name') }}
</x-mail::message>
