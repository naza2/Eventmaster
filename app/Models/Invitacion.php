<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitacion extends Model
{
    protected $table = 'invitaciones';

    protected $fillable = [
        'equipo_id',
        'invitado_por',
        'invitado_id',
        'estado',
        'mensaje',
        'respondida_en',
    ];

    protected $casts = [
        'respondida_en' => 'datetime',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }

    public function invitante()
    {
        return $this->belongsTo(User::class, 'invitado_por');
    }

    public function invitado(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invitado_id');
    }

    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeParaUsuario($query, $userId)
    {
        return $query->where('invitado_id', $userId);
    }

    public function aceptar(): bool
    {
        $this->estado = 'aceptada';
        $this->respondida_en = now();
        return $this->save();
    }

    public function rechazar(): bool
    {
        $this->estado = 'rechazada';
        $this->respondida_en = now();
        return $this->save();
    }
}
