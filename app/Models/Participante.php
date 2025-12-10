<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Participante extends Model
{
    protected $fillable = [
        'equipo_id', 'user_id', 'carrera_id', 'num_control', 'rol', 'es_lider'
    ];

    protected $casts = [
        'es_lider' => 'boolean',
    ];

   public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}