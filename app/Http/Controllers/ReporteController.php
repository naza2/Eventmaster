<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    /**
     * Generar reporte completo del evento en PDF
     */
    public function reporteEvento(Evento $evento)
    {
        $this->authorize('viewAny', $evento);

        $evento->load([
            'equipos.participantes.user.carrera',
            'equipos.calificaciones.criterio',
            'ganadores.equipo'
        ]);

        // Calcular promedios de calificaciones por equipo
        $equipos = $evento->equipos->map(function ($equipo) {
            $promedio = $equipo->calificaciones->avg('puntaje');
            $equipo->promedio_calificacion = round($promedio, 2);
            return $equipo;
        })->sortByDesc('promedio_calificacion');

        $pdf = PDF::loadView('pdf.reporte-evento', compact('evento', 'equipos'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Reporte-' . $evento->nombre . '.pdf');
    }

    /**
     * Generar reporte de ganadores en PDF
     */
    public function reporteGanadores(Evento $evento)
    {
        $this->authorize('viewAny', $evento);

        $evento->load([
            'ganadores.equipo.participantes.user.carrera',
            'ganadores.equipo.proyecto'
        ]);

        $ganadores = $evento->ganadores->sortBy('posicion');

        $pdf = PDF::loadView('pdf.reporte-ganadores', compact('evento', 'ganadores'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('Ganadores-' . $evento->nombre . '.pdf');
    }

    /**
     * Exportar participantes a Excel (CSV)
     */
    public function exportarParticipantes(Evento $evento)
    {
        $this->authorize('viewAny', $evento);

        $evento->load('equipos.participantes.user.carrera');

        $filename = 'Participantes-' . $evento->nombre . '-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($evento) {
            $file = fopen('php://output', 'w');

            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Encabezados
            fputcsv($file, [
                'Equipo',
                'Nombre',
                'Email',
                'Matrícula',
                'Carrera',
                'Rol en Equipo',
                'Teléfono'
            ]);

            // Datos
            foreach ($evento->equipos as $equipo) {
                foreach ($equipo->participantes as $participante) {
                    fputcsv($file, [
                        $equipo->nombre_equipo,
                        $participante->user->name,
                        $participante->user->email,
                        $participante->user->matricula ?? 'N/A',
                        $participante->carrera->nombre ?? 'N/A',
                        ucfirst($participante->rol),
                        $participante->user->telefono ?? 'N/A'
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Exportar calificaciones a Excel (CSV)
     */
    public function exportarCalificaciones(Evento $evento)
    {
        $this->authorize('viewAny', $evento);

        $evento->load([
            'equipos.calificaciones.criterio',
            'equipos.calificaciones.juez.user'
        ]);

        $filename = 'Calificaciones-' . $evento->nombre . '-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($evento) {
            $file = fopen('php://output', 'w');

            // BOM para UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Encabezados
            fputcsv($file, [
                'Equipo',
                'Proyecto',
                'Criterio',
                'Puntaje Máximo',
                'Puntaje Obtenido',
                'Juez',
                'Comentario'
            ]);

            // Datos
            foreach ($evento->equipos as $equipo) {
                foreach ($equipo->calificaciones as $calificacion) {
                    fputcsv($file, [
                        $equipo->nombre_equipo,
                        $equipo->nombre_proyecto,
                        $calificacion->criterio->nombre,
                        $calificacion->criterio->puntaje_maximo,
                        $calificacion->puntaje,
                        $calificacion->juez->user->name ?? 'N/A',
                        $calificacion->comentario ?? 'Sin comentarios'
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
