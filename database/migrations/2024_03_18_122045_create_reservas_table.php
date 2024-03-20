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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente', 45);
            $table->integer('num_pax');
            $table->integer('precio_total');
            $table->timestamp('fecha_reserva');
            $table->enum('estado', ['reservada','pagada'])->default('reservada');
            $table->unsignedBigInteger('id_viaje');
            $table->timestamps();

            $table->foreign('id_viaje')->references('id')->on('viajes')->onDelete('cascade'); //si elimino viaje, elimino reservas de éste
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
