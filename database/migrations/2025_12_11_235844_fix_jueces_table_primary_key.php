<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jueces', function (Blueprint $table) {
            // Primero eliminar la clave foránea de user_id
            $table->dropForeign(['user_id']);

            // Eliminar la clave primaria actual
            $table->dropPrimary(['user_id']);

            // Agregar id autoincrementable como nueva clave primaria
            $table->id()->first();

            // Recrear la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Crear índice único compuesto para evitar duplicados
            $table->unique(['user_id', 'evento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jueces', function (Blueprint $table) {
            // Revertir cambios
            $table->dropUnique(['user_id', 'evento_id']);
            $table->dropColumn('id');
            $table->primary('user_id');
        });
    }
};
