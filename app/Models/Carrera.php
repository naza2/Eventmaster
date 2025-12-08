<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrera extends Model
{
    protected $fillable = ['nombre', 'codigo', 'facultad', 'activa'];

    protected $casts = [
        'activa' => 'boolean',
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function participantes(): HasMany
    {
        return $this->hasMany(Participante::class);
    }

    public function especialidades(): HasMany
    {
        return $this->hasMany(Especialidad::class);
    }
}