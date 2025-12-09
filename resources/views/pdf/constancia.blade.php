<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constancia de Participación</title>
    <style>
        @page { margin: 0; size: A4 landscape; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Georgia', 'Times New Roman', serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
        }
        .certificate {
            background: white;
            padding: 50px 60px;
            border-radius: 10px;
            position: relative;
        }
        .certificate::before {
            content: '';
            position: absolute;
            top: 25px; left: 25px; right: 25px; bottom: 25px;
            border: 3px double #667eea;
        }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 {
            font-size: 42px; color: #667eea; font-weight: bold;
            letter-spacing: 3px; text-transform: uppercase;
        }
        .header p { font-size: 16px; color: #666; font-style: italic; }
        .content { text-align: center; margin: 35px 0; }
        .intro { font-size: 18px; color: #555; margin-bottom: 20px; }
        .team-name {
            font-size: 36px; color: #2d3748; font-weight: bold;
            margin: 25px 0; text-transform: uppercase; letter-spacing: 2px;
        }
        .project-name {
            font-size: 24px; color: #667eea; font-style: italic; margin: 15px 0;
        }
        .position {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 15px 50px; border-radius: 50px;
            font-size: 28px; font-weight: bold; margin: 25px 0;
        }
        .event-info {
            margin: 30px 0; padding: 20px; background: #f7fafc;
            border-radius: 8px; border-left: 4px solid #667eea;
        }
        .event-info h3 { font-size: 20px; color: #2d3748; margin-bottom: 12px; }
        .event-info p { font-size: 15px; color: #555; margin: 6px 0; }
        .event-info strong { color: #667eea; }
        .signatures { margin-top: 60px; display: table; width: 100%; }
        .signature { display: table-cell; text-align: center; padding: 15px; }
        .signature-line {
            border-top: 2px solid #333; margin: 40px auto 8px; width: 220px;
        }
        .signature-name { font-size: 14px; font-weight: bold; color: #2d3748; }
        .signature-title { font-size: 12px; color: #666; font-style: italic; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #888; }
        .footer .date { font-size: 14px; color: #555; margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <h1>Constancia de Reconocimiento</h1>
            <p>EventMaster - Plataforma de Eventos Académicos</p>
        </div>
        <div class="content">
            <p class="intro">Se extiende la presente constancia a:</p>
            <div class="team-name">{{ $ganador->equipo->nombre_equipo }}</div>
            <p class="intro">Por su destacada participación en el proyecto:</p>
            <div class="project-name">"{{ $ganador->equipo->nombre_proyecto }}"</div>
            <p class="intro">Habiendo obtenido el</p>
            @php
                $posiciones = [1 => '🥇 Primer Lugar', 2 => '🥈 Segundo Lugar', 3 => '🥉 Tercer Lugar'];
                $posicionTexto = $posiciones[$ganador->posicion] ?? $ganador->posicion . '° Lugar';
            @endphp
            <div class="position">{{ $posicionTexto }}</div>
            <div class="event-info">
                <h3>{{ $ganador->evento->nombre }}</h3>
                <p><strong>Fecha:</strong>
                    {{ \Carbon\Carbon::parse($ganador->evento->fecha_inicio)->format('d/m/Y') }} -
                    {{ \Carbon\Carbon::parse($ganador->evento->fecha_fin)->format('d/m/Y') }}
                </p>
                @if($ganador->premio)
                <p><strong>Premio otorgado:</strong> {{ $ganador->premio }}</p>
                @endif
            </div>
            <div class="event-info">
                <h3>Integrantes del Equipo</h3>
                @foreach($ganador->equipo->participantes as $participante)
                <p>{{ $participante->user->name }}
                    @if($participante->rol === 'lider')<strong>(Líder)</strong>@endif
                    - {{ $participante->carrera->nombre ?? '' }}
                </p>
                @endforeach
            </div>
        </div>
        <div class="signatures">
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-name">Director del Evento</div>
                <div class="signature-title">{{ config('app.name') }}</div>
            </div>
            <div class="signature">
                <div class="signature-line"></div>
                <div class="signature-name">Coordinador Académico</div>
                <div class="signature-title">Departamento de Innovación</div>
            </div>
        </div>
        <div class="footer">
            <p class="date">
                Expedido el {{ \Carbon\Carbon::parse($ganador->fecha_certificado ?? now())->format('d/m/Y') }}
            </p>
            <p>Este documento certifica la participación y logros obtenidos en el evento académico.</p>
        </div>
    </div>
</body>
</html>