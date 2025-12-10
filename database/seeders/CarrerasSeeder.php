<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carreras')->insert([
            [
                'codigo' => 'ISC',
                'nombre' => 'Sistemas',
                'facultad' => 'Ingeniería'
            ],
            [
                'codigo' => 'IQ',
                'nombre' => 'Química',
                'facultad' => 'Ingeniería Química'
            ],
            [
                'codigo' => 'IC',
                'nombre' => 'Civil',
                'facultad' => 'Ingeniería Civil'
            ],
            [
                'codigo' => 'LAE',
                'nombre' => 'Licenciatura',
                'facultad' => 'Administración'
            ],
            [
                'codigo' => 'FI',
                'nombre' => 'Física',
                'facultad' => 'Ciencias'
            ],
            [
                'codigo' => 'GEP',
                'nombre' => 'Gestión de Proyectos',
                'facultad' => 'Administración'
            ],
        ]);
    }
}
