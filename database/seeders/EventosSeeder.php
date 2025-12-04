<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;
use Carbon\Carbon;

class EventosSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            [
                'nombre' => 'Hackathon 2025',
                'slug' => 'hackathon-2025',
                'descripcion' => 'Competencia de desarrollo de software de 48 horas. Crea soluciones innovadoras para problemáticas reales.',
                'fecha_inicio' => Carbon::now()->addDays(10),
                'fecha_fin' => Carbon::now()->addDays(12),
                'estado' => 'inscripcion',
                'max_miembros' => 5,
            ],
            [
                'nombre' => 'InnovaTec 2025',
                'slug' => 'innovatec-2025',
                'descripcion' => 'Feria de innovación tecnológica donde presentas tu proyecto ante inversores y empresas.',
                'fecha_inicio' => Carbon::now()->addDays(30),
                'fecha_fin' => Carbon::now()->addDays(32),
                'estado' => 'inscripcion',
                'max_miembros' => 4,
            ],
            [
                'nombre' => 'Competencia de Análisis de Datos',
                'slug' => 'competencia-analisis-datos',
                'descripcion' => 'Analiza grandes volúmenes de datos y presenta insights valiosos. Demuestra tu dominio en Data Science.',
                'fecha_inicio' => Carbon::now()->addDays(20),
                'fecha_fin' => Carbon::now()->addDays(21),
                'estado' => 'inscripcion',
                'max_miembros' => 3,
            ],
            [
                'nombre' => 'Maratón de Diseño',
                'slug' => 'maraton-diseno',
                'descripcion' => 'Competencia de diseño UX/UI. Crea interfaces increíbles y experiencias memorables para usuarios.',
                'fecha_inicio' => Carbon::now()->addDays(15),
                'fecha_fin' => Carbon::now()->addDays(16),
                'estado' => 'inscripcion',
                'max_miembros' => 4,
            ],
        ];

        foreach ($eventos as $evento) {
            Evento::firstOrCreate(
                ['nombre' => $evento['nombre']],
                $evento
            );
        }
    }
}
