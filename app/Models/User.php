<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'matricula', 'carrera_id',
        'telefono', 'fecha_nacimiento', 'sexo', 'foto_perfil', 'verificado'
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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
