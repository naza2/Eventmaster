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
        Schema::table('users', function (Blueprint $table) {
            $table->string('matricula')->unique()->nullable()->after('email');
            $table->foreignId('carrera_id')->nullable()->constrained('carreras')->after('matricula');
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('sexo', ['M','F','Otro'])->nullable();
            $table->string('foto_perfil')->nullable();
            $table->boolean('verificado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
