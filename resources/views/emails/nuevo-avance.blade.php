<x-mail::message>
# Nuevo Avance Registrado

Hola equipo **{{ $equipo->nombre_equipo }}**,

**{{ $autor->name }}** ha registrado un nuevo avance en el proyecto:

## {{ $avance->titulo }}

**Descripción:**

{{ $avance->descripcion }}

---

**Progreso del proyecto:** {{ $avance->porcentaje_avance }}%

<x-mail::panel>
<div style="background: #e0e0e0; border-radius: 10px; height: 20px; overflow: hidden;">
    <div style="background: linear-gradient(90deg, #6366f1, #8b5cf6); width: {{ $avance->porcentaje_avance }}%; height: 100%;"></div>
</div>
</x-mail::panel>

@if($avance->evidencias && count($avance->evidencias) > 0)
## Evidencias Adjuntas

Se han subido {{ count($avance->evidencias) }} archivo(s) de evidencia.
@endif

## Ver Detalles Completos

<x-mail::button :url="$urlEquipo">
Ver Equipo y Avances
</x-mail::button>

¡Sigan así! El progreso constante es clave para el éxito.

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
