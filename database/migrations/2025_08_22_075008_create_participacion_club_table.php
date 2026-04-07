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
        Schema::create('participacion_club', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_entidad')->unsigned();
            $table->bigInteger('id_deporte')->unsigned();
            $table->bigInteger('id_modalidad')->unsigned();
            $table->boolean('intencion')->default(false);
            $table->integer('num_atl_fem')->nullable();
            $table->integer('num_atl_mas')->nullable();
            $table->integer('num_ent_fem')->nullable();
            $table->integer('num_ent_mas')->nullable();
            $table->integer('num_del_fem')->nullable();
            $table->integer('num_del_mas')->nullable();
            $table->integer('num_arb_fem')->nullable();
            $table->integer('num_arb_mas')->nullable();
            $table->integer('num_ofi_fem')->nullable();
            $table->integer('num_ofi_mas')->nullable();
            $table->integer('num_total_fem')->nullable();
            $table->integer('num_total_mas')->nullable();
            $table->integer('num_total')->nullable();
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->foreign('id_deporte')->references('id')->on('deportes')->cascadeOnDelete();
            $table->foreign('id_modalidad')->references('id')->on('modalidad_deportiva')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participacion_club');
    }
};
