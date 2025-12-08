<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Primero los roles y permisos
        $this->call([
            RolesAndPermissionsSeeder::class,
            EventosSeeder::class,
        ]);

        // Crear un usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@eventmaster.com'],
            [
                'name' => 'Administrador',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('administrador');

        // Crear un usuario participante de prueba
        $participante = User::firstOrCreate(
            ['email' => 'participante@eventmaster.com'],
            [
                'name' => 'Participante Demo',
                'password' => bcrypt('password'),
            ]
        );
        $participante->assignRole('participante');
    }
}
