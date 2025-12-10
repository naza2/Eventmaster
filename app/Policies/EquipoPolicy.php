<?php

namespace App\Policies;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipoPolicy
{
    use HandlesAuthorization;
    /**
     * Determine si el usuario puede crear un equipo
     */
    public function create(User $user): bool
    {
        // Solo usuarios con rol de líder de equipo pueden crear equipos
        return $user->hasRole('lider_equipo') || $user->hasRole('administrador');
    }

    /**
     * Determine si el usuario puede invitar miembros al equipo
     */
    public function invite(User $user, Equipo $equipo)
    {
        return $this->update($user, $equipo); // Solo el líder puede invitar
    }

    /**
     * Determine si el usuario puede actualizar el equipo
     */
    public function update(User $user, Equipo $equipo)
    {
        return $equipo->participantes()
            ->where('user_id', $user->id)
            ->where('rol', 'lider')
            ->exists();
    }

    public function view(User $user, Equipo $equipo)
    {
        return $equipo->participantes()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine si el usuario puede calificar el equipo
     */
    public function calificar(User $user, Equipo $equipo): bool
    {
        // Solo jueces del evento pueden calificar
        return $user->esJuezDe($equipo->evento);
    }
}
