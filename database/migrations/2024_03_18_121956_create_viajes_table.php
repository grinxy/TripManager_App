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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->date('fecha_salida');
            $table->date('fecha_regreso');
            $table->string('destino', 45);
            $table->integer('precio_persona');
            $table->integer('num_pax');
            $table->enum('estado', ['no confirmado','confirmado', 'completo'])->default('no confirmado');
            $table->text('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
