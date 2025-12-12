<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Juez extends Model
{
    protected $table = 'jueces';
    protected $fillable = ['user_id', 'evento_id', 'activo'];

    protected $casts = ['activo' => 'boolean'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function evento(): BelongsTo
    {
        return $this->belongsTo(Evento::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'juez_id', 'user_id');
    }
}