<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avance extends Model
{
    protected $fillable = [
        'proyecto_id', 'user_id', 'titulo', 'descripcion',
        'evidencias', 'porcentaje_avance'
    ];

    protected $casts = [
        'evidencias' => 'array',
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}