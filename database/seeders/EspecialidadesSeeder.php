<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;

class EspecialidadesSeeder extends Seeder
{
    public function run(): void
    {
        $especialidades = [
            ['carrera_id' => 1, 'nombre' => 'Sistemas', 'descripcion' => 'Especialidad en sistemas'],
            ['carrera_id' => 2, 'nombre' => 'Química', 'descripcion' => 'Especialidad en química'],
            ['carrera_id' => 3, 'nombre' => 'Civil', 'descripcion' => 'Especialidad en ingeniería civil'],
            ['carrera_id' => 4, 'nombre' => 'Licenciatura', 'descripcion' => 'Especialidad en licenciatura'],
            ['carrera_id' => 5, 'nombre' => 'Física', 'descripcion' => 'Especialidad en física'],
            ['carrera_id' => 6, 'nombre' => 'Gestión de Proyectos', 'descripcion' => 'Especialidad en gestión de proyectos'],
        ];

        foreach ($especialidades as $e) {
            Especialidad::create($e);
        }
    }
}
