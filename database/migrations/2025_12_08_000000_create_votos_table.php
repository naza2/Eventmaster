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
        Schema::create('votos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juez_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('primer_lugar_id')->nullable()->constrained('equipos')->onDelete('set null');
            $table->foreignId('segundo_lugar_id')->nullable()->constrained('equipos')->onDelete('set null');
            $table->foreignId('tercer_lugar_id')->nullable()->constrained('equipos')->onDelete('set null');
            $table->text('comentario')->nullable();
            $table->timestamps();

            // Un juez solo puede votar una vez por evento
            $table->unique(['juez_id', 'evento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votos');
    }
};
