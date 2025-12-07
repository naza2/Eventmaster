<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method bool hasRole($roles, string $guard = null)
 * @method bool hasAnyRole($roles, string $guard = null)
 * @method $this assignRole(...$roles)
 * @method $this syncRoles(...$roles)
 * @method $this removeRole($role)
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'matricula', 'carrera_id',
        'telefono', 'fecha_nacimiento', 'sexo', 'foto_perfil', 'verificado',
        'especialidad'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_nacimiento' => 'date',
        'verificado' => 'boolean',
    ];

    /**
     * Convertir email a minúsculas automáticamente
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'participantes');
    }

    public function esJuezDe(Evento $evento): bool
    {
        return $this->jueces()->where('evento_id', $evento->getKey())->exists();
    }

    public function jueces(): HasMany
    {
        return $this->hasMany(Juez::class);
    }

    public function invitacionesRecibidas(): HasMany
    {
        return $this->hasMany(Invitacion::class, 'invitado_id');
    }

    public function invitacionesEnviadas(): HasMany
    {
        return $this->hasMany(Invitacion::class, 'invitado_por');
    }

    public function invitacionesPendientes(): HasMany
    {
        return $this->invitacionesRecibidas()->where('estado', 'pendiente');
    }

    public function esLiderDeEquipo(): bool
    {
        return $this->hasRole('lider_equipo');
    }

    public function esJuez(): bool
    {
        return $this->hasRole('juez');
    }

    public function esAdmin(): bool
    {
        return $this->hasRole('administrador');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
