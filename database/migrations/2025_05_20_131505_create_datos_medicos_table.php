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
        Schema::create('datos_medicos', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->string('RH')->nullable();
            $table->boolean('alergico')->default(false);
            $table->boolean('ant_medicos')->default(false);
            $table->string('alergias')->nullable();
            $table->text('antecedentes')->nullable();
            $table->string('avisar_a')->nullable();
            $table->string('telefono')->nullable();
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_medicos');
    }
};
