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
        Schema::create('seguridad', function (Blueprint $table) {
            $table->id();
            $table->string('cod_seguridad');
            $table->string('color_seguridad');
            $table->text('permisos')->nullable();
            $table->string('nombre_seguridad')->nullable();
            $table->string('color_cmyk')->nullable();
            $table->string('color_rgb')->nullable();
            $table->string('color_letra')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguridad');
    }
};
