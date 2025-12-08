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

        // Crear rol de Participante
        $participante = Role::firstOrCreate([
            'name' => 'participante',
            'guard_name' => $guard,
        ]);
        $participante->givePermissionTo(Permission::where('guard_name', $guard)->whereIn('name', ['join-team', 'view-events', 'create-team'])->get());
    }
}
