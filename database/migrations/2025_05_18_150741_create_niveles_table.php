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
        Schema::create('niveles', function (Blueprint $table) {
            $table->id();
            $table->string('id_nivel')->unique();
            $table->bigInteger('id_permiso')->unsigned();
            $table->string('nivel')->nullable();
            $table->boolean('activo')->default(true);
            $table->foreign('id_permiso')->references('id')->on('permisos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveles');
    }
};
