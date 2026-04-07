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
        Schema::create('modalidad_deportiva', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_deporte')->unsigned();
            $table->string('codigod');
            $table->string('codigo_modalidad');
            $table->string('modalidad');
            $table->boolean('masculino')->default(true);
            $table->boolean('femenino')->default(true);
            $table->boolean('puntuable')->default(false);
            $table->boolean('en_practica')->default(true);
            $table->date('rango_minimo')->nullable();
            $table->date('rango_maximo')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('es_equipo')->default(false);
            $table->string('modality')->nullable();
            $table->integer('IdModalAccess')->nullable();
            $table->integer('IdCategAccess')->nullable();
            $table->integer('Orden')->nullable();
            $table->foreign('id_deporte')->references('id')->on('deportes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modalidad_deportiva');
    }
};
