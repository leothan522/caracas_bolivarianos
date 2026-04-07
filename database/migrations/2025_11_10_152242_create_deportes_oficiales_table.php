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
        Schema::create('deportes_oficiales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_deporte')->unsigned();
            $table->string('categoria');
            $table->integer('min');
            $table->integer('max');
            $table->string('genero');
            $table->boolean('edad_libre')->default(false);
            $table->string('edad_inicial')->nullable();
            $table->string('edad_final')->nullable();
            $table->boolean('fecha_libre')->default(false);
            $table->string('fecha_inicial')->nullable();
            $table->string('fecha_final')->nullable();
            $table->foreign('id_deporte')->references('id')->on('deportes')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deportes_oficiales');
    }
};
