<?php

namespace App\Policies;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipoPolicy
{
    use HandlesAuthorization;

    /**
     * Los administradores pueden hacer CUALQUIER cosa
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('administrador')) {
            return true;
        }

        return null;
    }

    /**
     * Determine si el usuario puede actualizar el equipo
     */
    public function update(User $user, Equipo $equipo): bool
    {
        \Log::info('EquipoPolicy@update', [
            'user_id' => $user->id,
            'equipo_id' => $equipo->id,
            'participantes' => $equipo->participantes()->get()->toArray(),
        ]);

        $esLider = $equipo->participantes()
            ->where('user_id', $user->id)
            ->where('es_lider', true)
            ->exists();

        \Log::info('¿Es líder?', ['resultado' => $esLider]);

        return $esLider;
    }

    /**
     * Determine si el usuario puede ver el equipo
     */
    public function view(User $user, Equipo $equipo): bool
    {
        return $equipo->participantes()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * Determine si el usuario puede eliminar el equipo
     */
    public function delete(User $user, Equipo $equipo): bool
    {
        return $equipo->participantes()
            ->where('user_id', $user->id)
            ->where('es_lider', true)
            ->exists();
    }

    /**
     * Determine si el usuario puede crear un equipo
     */
    public function create(User $user): bool
    {
        return $user->hasRole('lider_equipo');
    }

    /**
     * Determine si el usuario puede invitar miembros al equipo
     */
    public function invite(User $user, Equipo $equipo): bool
    {
        return $this->update($user, $equipo);
    }

    /**
     * Determine si el usuario puede calificar el equipo
     */
    public function calificar(User $user, Equipo $equipo): bool
    {
        return $user->hasRole('juez');
    }
}