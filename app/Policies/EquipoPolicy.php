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
     * Determine si el usuario puede crear un equipo
     */
    public function create(User $user): bool
    {
        // Solo usuarios con rol de usuario (alumno) pueden crear equipos
        return $user->hasRole('usuario');
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

    /**
     * Determine si el usuario puede eliminar el equipo
     */
    public function delete(User $user, Equipo $equipo): bool
    {
        // Solo el líder del equipo puede eliminarlo (o admin por el método before)
        return $equipo->participantes()
            ->where('user_id', $user->id)
            ->where('es_lider', true)
            ->exists();
    }
}
