<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ganadores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #f59e0b;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            color: #f59e0b;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
            font-size: 14px;
        }
        .ganador-card {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .ganador-card.primero { border-color: #fbbf24; background: #fffbeb; }
        .ganador-card.segundo { border-color: #c0c0c0; background: #f9f9f9; }
        .ganador-card.tercero { border-color: #cd7f32; background: #fef3e2; }
        .ganador-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .posicion {
            font-size: 32px;
            margin-right: 15px;
        }
        .equipo-info h2 {
            margin: 0;
            font-size: 18px;
            color: #1f2937;
        }
        .equipo-info p {
            margin: 3px 0;
            color: #666;
            font-style: italic;
        }
        .section-subtitle {
            font-weight: bold;
            color: #667eea;
            margin-top: 12px;
            margin-bottom: 6px;
            font-size: 13px;
        }
        .participantes-list {
            list-style: none;
            padding: 0;
            margin: 8px 0;
        }
        .participantes-list li {
            padding: 4px 0;
            border-bottom: 1px dotted #ddd;
        }
        .participantes-list li:last-child {
            border-bottom: none;
        }
        .premio-box {
            background: #f0fdf4;
            border-left: 3px solid #10b981;
            padding: 10px;
            margin-top: 10px;
            font-weight: bold;
            color: #065f46;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏆 Ganadores del Evento</h1>
        <p><strong>{{ $evento->nombre }}</strong></p>
        <p>{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} -
           {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}</p>
    </div>

    @foreach($ganadores as $ganador)
        @php
            $claseCard = '';
            $iconoPosicion = '';
            if($ganador->posicion == 1) {
                $claseCard = 'primero';
                $iconoPosicion = '🥇';
            } elseif($ganador->posicion == 2) {
                $claseCard = 'segundo';
                $iconoPosicion = '🥈';
            } elseif($ganador->posicion == 3) {
                $claseCard = 'tercero';
                $iconoPosicion = '🥉';
            }
        @endphp

        <div class="ganador-card {{ $claseCard }}">
            <div class="ganador-header">
                <div class="posicion">{{ $iconoPosicion }}</div>
                <div class="equipo-info">
                    <h2>{{ $ganador->equipo->nombre_equipo }}</h2>
                    <p>"{{ $ganador->equipo->nombre_proyecto }}"</p>
                </div>
            </div>

            <div class="section-subtitle">👥 Integrantes del Equipo</div>
            <ul class="participantes-list">
                @foreach($ganador->equipo->participantes as $participante)
                <li>
                    <strong>{{ $participante->user->name }}</strong>
                    @if($participante->rol === 'lider')
                        <em>(Líder)</em>
                    @endif
                    - {{ $participante->carrera->nombre ?? 'Carrera no especificada' }}
                    @if($participante->user->matricula)
                        | Matrícula: {{ $participante->user->matricula }}
                    @endif
                </li>
                @endforeach
            </ul>

            @if($ganador->equipo->proyecto)
            <div class="section-subtitle">📝 Descripción del Proyecto</div>
            <p style="text-align: justify; line-height: 1.5;">
                {{ $ganador->equipo->proyecto->problema_resuelto ?? $ganador->equipo->descripcion_proyecto }}
            </p>
            @endif

            @if($ganador->premio)
            <div class="premio-box">
                🎁 Premio: {{ $ganador->premio }}
            </div>
            @endif

            @if($ganador->comentario_jurado)
            <div class="section-subtitle">💭 Comentario del Jurado</div>
            <p style="font-style: italic; color: #555; line-height: 1.5;">
                "{{ $ganador->comentario_jurado }}"
            </p>
            @endif
        </div>
    @endforeach

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y H:i:s') }} | {{ config('app.name') }}</p>
        <p>¡Felicitaciones a todos los ganadores por su excelente trabajo!</p>
    </div>
</body>
</html>
