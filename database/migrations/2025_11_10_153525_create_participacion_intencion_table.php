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
        Schema::create('participacion_intencion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_entidad');
            $table->text('responsable_club')->nullable();
            $table->integer('femenino')->nullable();
            $table->integer('masculino')->nullable();
            $table->integer('total')->nullable();
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participacion_intencion');
    }
};
