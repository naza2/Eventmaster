<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ganador extends Model
{
    protected $table = 'ganadores';

    protected $fillable = [
        'evento_id', 'equipo_id', 'posicion', 'premio',
        'comentario_jurado', 'fecha_certificado', 'certificado_enviado'
    ];

    protected $casts = [
        'fecha_certificado' => 'date',
        'certificado_enviado' => 'boolean',
    ];

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}