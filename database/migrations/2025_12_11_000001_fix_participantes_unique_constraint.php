<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            // Eliminar la restricción única de num_control
            $table->dropUnique(['num_control']);

            // Agregar restricción única compuesta: un usuario NO puede estar dos veces en el MISMO equipo
            $table->unique(['user_id', 'equipo_id'], 'participantes_user_equipo_unique');
        });
    }

    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            // Revertir cambios
            $table->dropUnique('participantes_user_equipo_unique');
            $table->unique('num_control');
        });
    }
};
