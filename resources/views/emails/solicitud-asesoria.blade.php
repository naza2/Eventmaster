<x-mail::message>
# Nueva Solicitud de Asesoría

Hola,

El equipo **{{ $equipo->nombre_equipo }}** ha solicitado tu asesoría para su proyecto en el evento **{{ $evento->nombre }}**.

## Detalles del Equipo

- **Nombre del equipo:** {{ $equipo->nombre_equipo }}
- **Proyecto:** {{ $equipo->nombre_proyecto }}
- **Evento:** {{ $evento->nombre }}
- **Descripción del proyecto:** {{ \Str::limit($equipo->descripcion_proyecto, 200) }}

@if($asesoria->comentarios)
## Mensaje del Equipo:

<x-mail::panel>
{{ $asesoria->comentarios }}
</x-mail::panel>
@endif

## ¿Deseas ser su asesor?

Si estás interesado en apoyar a este equipo, puedes aceptar la solicitud haciendo clic en el botón de abajo:

<x-mail::button :url="$urlAceptar" color="primary">
Aceptar Solicitud de Asesoría
</x-mail::button>

<x-mail::button :url="$urlSolicitudes">
Ver Todas Mis Solicitudes
</x-mail::button>

Tu experiencia y conocimientos pueden marcar la diferencia en el éxito de este proyecto.

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
