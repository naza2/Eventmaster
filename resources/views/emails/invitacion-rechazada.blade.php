<x-mail::message>
# Invitación Rechazada

Hola,

Lamentamos informarte que **{{ $usuarioRechazado->name }}** ha rechazado la invitación para unirse al equipo **{{ $equipo->nombre_equipo }}**.

## ¿Qué puedes hacer?

No te preocupes, aún puedes invitar a otros participantes para completar tu equipo y participar en **{{ $evento->nombre }}**.

<x-mail::panel>
Recuerda que el evento tiene un límite de {{ $evento->max_miembros ?? 5 }} miembros por equipo.
</x-mail::panel>

<x-mail::button :url="$urlInvitar">
Invitar a Otro Participante
</x-mail::button>

¡No te rindas! Encuentra al equipo perfecto para tu proyecto.

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
