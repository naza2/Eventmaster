<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Determinar guard desde la configuración (por defecto 'web')
        $guard = config('auth.defaults.guard', 'web');

        // Crear permisos
        $permissions = [
            'manage-users',
            'manage-events',
            'manage-teams',
            'create-team',
            'join-team',
            'view-events',
<<<<<<< HEAD
            'invite-members',
            'evaluate-projects',
            'generate-certificates',
=======
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guard,
            ]);
        }

        // Crear rol de Administrador
        $admin = Role::firstOrCreate([
            'name' => 'administrador',
            'guard_name' => $guard,
        ]);
        $admin->givePermissionTo(Permission::where('guard_name', $guard)->get());

<<<<<<< HEAD
        // Crear rol de Líder de Equipo
        $lider = Role::firstOrCreate([
            'name' => 'lider_equipo',
            'guard_name' => $guard,
        ]);
        $lider->givePermissionTo(['create-team', 'invite-members', 'view-events']);

        // Crear rol de Juez
        $juez = Role::firstOrCreate([
            'name' => 'juez',
            'guard_name' => $guard,
        ]);
        $juez->givePermissionTo(['evaluate-projects', 'view-events']);

        // Crear rol de Usuario (participante)
        $usuario = Role::firstOrCreate([
            'name' => 'usuario',
            'guard_name' => $guard,
        ]);
        $usuario->givePermissionTo(['join-team', 'view-events']);
=======
        // Crear rol de Participante
        $participante = Role::firstOrCreate([
            'name' => 'participante',
            'guard_name' => $guard,
        ]);
        $participante->givePermissionTo(Permission::where('guard_name', $guard)->whereIn('name', ['join-team', 'view-events', 'create-team'])->get());
>>>>>>> 952eaa0e88cd2a848c95971393bb77e190f53807
    }
}
