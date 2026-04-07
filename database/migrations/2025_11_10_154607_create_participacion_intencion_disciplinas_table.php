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
        Schema::create('participacion_intencion_disciplinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_entidad');
            $table->bigInteger('id_deporte_oficial')->unsigned();
            $table->integer('femenino')->nullable();
            $table->integer('masculino')->nullable();
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->foreign('id_deporte_oficial')->references('id')->on('deportes_oficiales')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participacion_intencion_disciplinas');
    }
};
