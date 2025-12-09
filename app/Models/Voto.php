<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voto extends Model
{
    use HasFactory;

    protected $fillable = [
        'juez_id',
        'evento_id',
        'primer_lugar_id',
        'segundo_lugar_id',
        'tercer_lugar_id',
        'comentario',
    ];

    /**
     * Get the juez that owns the vote.
     */
    public function juez(): BelongsTo
    {
        return $this->belongsTo(User::class, 'juez_id');
    }

    /**
     * Get the evento that owns the vote.
     */
    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Get the equipo in primer lugar.
     */
    public function primerLugar(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'primer_lugar_id');
    }

    /**
     * Get the equipo in segundo lugar.
     */
    public function segundoLugar(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'segundo_lugar_id');
    }

    /**
     * Get the equipo in tercer lugar.
     */
    public function tercerLugar(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'tercer_lugar_id');
    }
}
