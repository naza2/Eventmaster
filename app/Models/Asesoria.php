<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asesoria extends Model
{
    protected $fillable = ['equipo_id', 'user_id', 'aprobado', 'comentarios'];

    protected $casts = ['aprobado' => 'boolean'];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }

    public function asesor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}