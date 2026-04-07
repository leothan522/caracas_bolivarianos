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
        Schema::create('acreditacion_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_ente')->unsigned();
            $table->bigInteger('id_entidad')->unsigned();
            $table->string('placa_vehiculo')->nullable();
            $table->string('color_banda')->nullable();
            $table->string('serial_asignado')->nullable();
            $table->string('cedula_chofer')->nullable();
            $table->string('nombre_chofer')->nullable();
            $table->foreign('id_ente')->references('id')->on('entes_responsables')->cascadeOnDelete();
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acreditacion_vehiculos');
    }
};
