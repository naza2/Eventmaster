<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte del Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #667eea;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background: #667eea;
            color: white;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background: #f0f0f0;
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }
        td {
            padding: 6px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .info-box {
            background: #f7fafc;
            border-left: 4px solid #667eea;
            padding: 12px;
            margin-bottom: 15px;
        }
        .info-box strong {
            color: #667eea;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success { background: #10b981; color: white; }
        .badge-warning { background: #f59e0b; color: white; }
        .badge-info { background: #3b82f6; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 Reporte del Evento</h1>
        <p><strong>{{ $evento->nombre }}</strong></p>
        <p>{{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} -
           {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}</p>
    </div>

    <div class="section">
        <div class="section-title">📋 Información General</div>
        <div class="info-box">
            <p><strong>Descripción:</strong> {{ $evento->descripcion ?? 'Sin descripción' }}</p>
            <p><strong>Estado:</strong> <span class="badge badge-info">{{ ucfirst($evento->estado) }}</span></p>
            <p><strong>Máximo de miembros por equipo:</strong> {{ $evento->max_miembros ?? 5 }}</p>
            <p><strong>Total de equipos registrados:</strong> {{ $evento->equipos->count() }}</p>
            <p><strong>Total de participantes:</strong>
                {{ $evento->equipos->sum(function($e) { return $e->participantes->count(); }) }}
            </p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">🏆 Equipos y Calificaciones</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Equipo</th>
                    <th>Proyecto</th>
                    <th>Integrantes</th>
                    <th>Promedio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($equipos as $index => $equipo)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $equipo->nombre_equipo }}</td>
                    <td>{{ $equipo->nombre_proyecto }}</td>
                    <td>{{ $equipo->participantes->count() }}</td>
                    <td>
                        @if($equipo->promedio_calificacion)
                            <strong>{{ $equipo->promedio_calificacion }}</strong> / 100
                        @else
                            Sin calificar
                        @endif
                    </td>
                    <td>
                        @if($equipo->estado === 'aprobado')
                            <span class="badge badge-success">Aprobado</span>
                        @elseif($equipo->estado === 'pendiente')
                            <span class="badge badge-warning">Pendiente</span>
                        @else
                            <span class="badge">{{ $equipo->estado }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($evento->ganadores->count() > 0)
    <div class="section">
        <div class="section-title">🥇 Ganadores</div>
        <table>
            <thead>
                <tr>
                    <th>Posición</th>
                    <th>Equipo</th>
                    <th>Proyecto</th>
                    <th>Premio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evento->ganadores->sortBy('posicion') as $ganador)
                <tr>
                    <td>
                        @if($ganador->posicion == 1) 🥇 1°
                        @elseif($ganador->posicion == 2) 🥈 2°
                        @elseif($ganador->posicion == 3) 🥉 3°
                        @else {{ $ganador->posicion }}°
                        @endif
                    </td>
                    <td>{{ $ganador->equipo->nombre_equipo }}</td>
                    <td>{{ $ganador->equipo->nombre_proyecto }}</td>
                    <td>{{ $ganador->premio ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>Generado el {{ now()->format('d/m/Y H:i:s') }} | {{ config('app.name') }}</p>
        <p>Este documento es un reporte oficial del evento académico.</p>
    </div>
</body>
</html>
