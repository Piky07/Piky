<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fotos_actividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actividad_id')->constrained('actividades')->onDelete('cascade');
            $table->string('ruta_archivo');
            $table->string('nombre_original');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fotos_actividades');
    }
};
