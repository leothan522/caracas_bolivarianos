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
        Schema::create('voluntario_areas', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->bigInteger('cod_area')->unsigned();
            $table->foreign('cod_area')->references('id')->on('codigo_area')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voluntario_areas');
    }
};
