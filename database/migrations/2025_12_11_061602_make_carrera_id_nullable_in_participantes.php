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
        Schema::table('participantes', function (Blueprint $table) {
            $table->unsignedBigInteger('carrera_id')->nullable()->change();
            $table->string('num_control')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            $table->unsignedBigInteger('carrera_id')->nullable(false)->change();
            $table->string('num_control')->nullable(false)->change();
        });
    }
};
