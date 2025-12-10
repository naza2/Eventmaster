<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $guard = config('auth.defaults.guard', 'web');

        $permissions = [
            'manage-users',
            'manage-events',
            'manage-teams',
            'create-team',
            'join-team',
            'view-events',
            'invite-members',
            'evaluate-projects',
            'generate-certificates',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $guard,
            ]);
        }

        // ADMIN
        $admin = Role::firstOrCreate([
            'name' => 'administrador',
            'guard_name' => $guard,
        ]);
        $admin->givePermissionTo(Permission::where('guard_name', $guard)->get());

        // LÍDER DE EQUIPO
        $lider = Role::firstOrCreate([
            'name' => 'lider_equipo',
            'guard_name' => $guard,
        ]);
        $lider->givePermissionTo(['create-team', 'invite-members', 'view-events']);

        // JUEZ
        $juez = Role::firstOrCreate([
            'name' => 'juez',
            'guard_name' => $guard,
        ]);
        $juez->givePermissionTo(['evaluate-projects', 'view-events']);

        // USUARIO
        $usuario = Role::firstOrCreate([
            'name' => 'usuario',
            'guard_name' => $guard,
        ]);
        $usuario->givePermissionTo(['join-team', 'view-events']);

        // PARTICIPANTE (ROL QUE FALTABA)
        $participante = Role::firstOrCreate([
            'name' => 'participante',
            'guard_name' => $guard,
        ]);
        $participante->givePermissionTo(['view-events']);
    }
}
