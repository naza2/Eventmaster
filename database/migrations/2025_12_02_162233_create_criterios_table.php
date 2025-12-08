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
        Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especialidad_id')->nullable()->constrained('especialidades')->nullOnDelete();
            $table->foreignId('evento_id')->nullable()->constrained('eventos')->nullOnDelete();
            $table->string('nombre');
            $table->text('descripcion');
            $table->integer('puntaje_maximo')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterios');
    }
};
