<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modificar la columna rol para incluir 'miembro'
        DB::statement("ALTER TABLE participantes MODIFY COLUMN rol ENUM('lider','programador','diseñador','analista_negocios','analista_datos','miembro','otro') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Volver al ENUM original sin 'miembro'
        DB::statement("ALTER TABLE participantes MODIFY COLUMN rol ENUM('lider','programador','diseñador','analista_negocios','analista_datos','otro') NOT NULL");
    }
};
