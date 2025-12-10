<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;

class Equipo extends Model
{
    protected $fillable = [
        'evento_id', 'nombre_equipo', 'nombre_proyecto',
        'descripcion_proyecto', 'logo', 'estado'
    ];

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function participantes()
    {
        return $this->hasMany(Participante::class); // ← hasMany, NO belongsToMany
    }

    public function proyecto(): HasOne
    {
        return $this->hasOne(Proyecto::class);
    }

    public function avances()
    {
        return $this->hasManyThrough(Avance::class, Proyecto::class);
    }

    public function asesorias(): HasMany
    {
        return $this->hasMany(Asesoria::class);
    }

    public function calificaciones(): HasMany
    {
        return $this->hasMany(Calificacion::class);
    }

    public function esLider(User $user): bool
    {
        return $this->participantes()->where('user_id', $user->getKey())->where('es_lider', true)->exists();
    }

    public function asesoriaAprobada()
    {
        return $this->hasOne(Asesoria::class)->where('aprobado', true);
    }

    public function asesoriaPendiente()
    {
        return $this->hasOne(Asesoria::class)->where('aprobado', false);
    }

    public function lider()
    {
        return $this->hasOne(Participante::class)->where('rol', 'lider');
    }
}