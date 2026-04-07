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
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->nullable();
            $table->bigInteger('id_entidad')->unsigned();
            $table->string('carnet');
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('tiposocio')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('sexo')->nullable();
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socios');
    }
};
