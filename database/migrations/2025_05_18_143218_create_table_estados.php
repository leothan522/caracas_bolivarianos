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
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('codigoe');
            $table->string('nombre');
            $table->string('short_nombre')->nullable();
            $table->string('capital')->nullable();
            $table->text('ruta_bandera')->nullable();
            $table->text('ruta_escudo')->nullable();
            $table->boolean('activo')->default(true);
            $table->boolean('is_delegacion')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
