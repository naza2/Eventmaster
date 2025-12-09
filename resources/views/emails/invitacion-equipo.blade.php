<x-mail::message>
# ¡Te han invitado a unirte a un equipo!

Hola **{{ $invitacion->invitado->name }}**,

**{{ $invitante->name }}** te ha invitado a formar parte del equipo **{{ $equipo->nombre_equipo }}** para el evento **{{ $evento->nombre }}**.

## Detalles del Equipo

- **Nombre del equipo:** {{ $equipo->nombre_equipo }}
- **Proyecto:** {{ $equipo->nombre_proyecto }}
- **Evento:** {{ $evento->nombre }}
- **Fecha del evento:** {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}

@if($invitacion->mensaje)
## Mensaje de {{ $invitante->name }}:

> {{ $invitacion->mensaje }}
@endif

## ¿Qué deseas hacer?

<x-mail::panel>
Esta invitación es una gran oportunidad para participar en {{ $evento->nombre }} y colaborar con un equipo talentoso.
</x-mail::panel>

<x-mail::button :url="$urlAceptar" color="success">
Aceptar Invitación
</x-mail::button>

<x-mail::button :url="$urlRechazar" color="error">
Rechazar Invitación
</x-mail::button>

Gracias por ser parte de EventMaster,<br>
{{ config('app.name') }}
</x-mail::message>
