<x-mail::message>
# ¡Excelentes noticias!

Hola,

**{{ $nuevoMiembro->name }}** ha aceptado tu invitación y ahora es parte del equipo **{{ $equipo->nombre_equipo }}**.

## Detalles del Nuevo Miembro

- **Nombre:** {{ $nuevoMiembro->name }}
- **Email:** {{ $nuevoMiembro->email }}
- **Carrera:** {{ $nuevoMiembro->carrera->nombre ?? 'No especificada' }}

## Próximos Pasos

Ya puedes comenzar a colaborar con {{ $nuevoMiembro->name }} en el desarrollo de tu proyecto **{{ $equipo->nombre_proyecto }}**.

<x-mail::button :url="$urlEquipo">
Ver Equipo Completo
</x-mail::button>

¡Mucho éxito en {{ $evento->nombre }}!

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
