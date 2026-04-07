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
        Schema::create('acceso', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->boolean('comedor')->default(false);
            $table->boolean('ceremonia')->default(false);
            $table->boolean('anti_doping')->default(false);
            $table->boolean('villa')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acceso');
    }
};
