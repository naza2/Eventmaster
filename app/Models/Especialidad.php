<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especialidad extends Model
{
    protected $table = 'especialidades'; // ← ESTA LÍNEA ES OBLIGATORIA

    protected $fillable = ['carrera_id', 'nombre', 'descripcion'];

    public function carrera(): BelongsTo
    {
        return $this->belongsTo(Carrera::class);
    }

    public function criterios(): HasMany
    {
        return $this->hasMany(Criterio::class);
    }
}
