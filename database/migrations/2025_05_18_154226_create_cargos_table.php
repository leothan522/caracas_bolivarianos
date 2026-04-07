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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_seguridad')->unsigned()->nullable();
            $table->string('cod_cargo')->nullable();
            $table->string('cargo')->nullable();
            $table->string('descrip')->nullable();
            $table->string('nombre_cargo')->nullable();
            $table->boolean('activo')->default(true);
            $table->integer('color')->default(0);
            $table->integer('letra')->default(0);
            $table->integer('hotel')->default(0);
            $table->integer('palco')->default(0);
            $table->integer('transporte')->default(0);
            $table->integer('num2')->default(0);
            $table->integer('num3')->default(0);
            $table->integer('num4')->default(0);
            $table->integer('num5')->default(0);
            $table->integer('num6')->default(0);
            $table->integer('comida')->default(0);
            $table->integer('acceso1')->default(0);
            $table->integer('acceso2')->default(0);
            $table->integer('acceso3')->default(0);
            $table->integer('acceso4')->default(0);
            $table->integer('acceso5')->default(0);
            $table->integer('codigo')->default(0);
            $table->text('imagen')->nullable();
            $table->string('internet')->nullable();
            $table->foreign('id_seguridad')->references('id')->on('seguridad')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
