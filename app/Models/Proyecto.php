<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    protected $fillable = [
        'equipo_id', 'problema_resuelto', 'solucion_propuesta', 'impacto_social'
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }

    public function repositorio(): HasOne
    {
        return $this->hasOne(Repositorio::class);
    }

    public function avances(): HasMany
    {
        return $this->hasMany(Avance::class);
    }
}