<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->text('descripcion');
            $table->string('marca');
            $table->string('modelo');
            $table->string('chasis')->nullable();
            $table->string('numero_motor')->nullable();
            $table->string('vin')->nullable();
            $table->string('placa')->nullable();
            $table->string('color')->nullable();
            $table->integer('ano')->nullable();
            $table->string('propietario');
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->enum('estado', ['disponible', 'en_reparacion', 'inactivo'])->default('disponible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
