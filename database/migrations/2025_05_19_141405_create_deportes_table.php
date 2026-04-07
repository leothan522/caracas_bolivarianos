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
        Schema::create('deportes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tipo_deporte')->unsigned();
            $table->string('codigod');
            $table->string('deporte');
            $table->boolean('en_uso')->default(true);
            $table->string('acronimo');
            $table->text('ruta_logo')->nullable();
            $table->boolean('listo')->default(false);
            $table->string('federacion')->nullable();
            $table->string('presidente')->nullable();
            $table->string('url_federacion')->nullable();
            $table->string('email')->nullable();
            $table->text('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('fax')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('url_ranking')->nullable();
            $table->boolean('clasificatorio')->default(false);
            $table->string('plan')->nullable();
            $table->date('rango_minimo')->nullable();
            $table->date('rango_maximo')->nullable();
            $table->bigInteger('secundario')->unsigned()->nullable();
            $table->string('sport')->nullable();
            $table->foreign('tipo_deporte')->references('id')->on('tipo_deporte')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deportes');
    }
};
