<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evento extends Model
{
    protected $fillable = [
        'nombre', 'slug', 'descripcion', 'banner', 'fecha_inicio',
        'fecha_fin', 'max_miembros', 'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class);
    }

    public function jueces(): HasMany
    {
        return $this->hasMany(Juez::class);
    }

    public function criterios(): HasMany
    {
        return $this->hasMany(Criterio::class);
    }

    public function ganadores(): HasMany
    {
        return $this->hasMany(Ganador::class);
    }

    public function scopeActivo($query)
    {
        return $query->whereIn('estado', ['inscripcion', 'en_curso']);
    }
}