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
        Schema::create('prensa_medios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_entidad')->unsigned();
            $table->bigInteger('id_tipo_medio')->unsigned();
            $table->string('nombre_medio');
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->foreign('id_tipo_medio')->references('id')->on('tipo_socio')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prensa_medios');
    }
};
