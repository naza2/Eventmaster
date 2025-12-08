<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $fillable = ['equipo_id', 'juez_id', 'criterio_id', 'puntaje', 'comentario'];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function juez()
    {
        return $this->belongsTo(User::class, 'juez_id');
    }

    public function criterio()
    {
        return $this->belongsTo(Criterio::class);
    }
}