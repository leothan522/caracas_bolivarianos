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
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->bigInteger('id_entidad')->unsigned();
            $table->bigInteger('id_entidad_responsable')->unsigned()->nullable();
            $table->bigInteger('id_cargo')->unsigned()->nullable()->nullable();
            $table->bigInteger('status_acreditacion')->unsigned()->nullable();
            $table->string('primer_apellido')->nullable();
            $table->string('segundo_apellido')->nullable();
            $table->string('primer_nombre')->nullable();
            $table->string('segundo_nombre')->nullable();
            $table->boolean('sexo')->default(false);
            $table->date('fecha_nacimiento')->nullable();
            $table->dateTime('fecha_activacion')->nullable();
            $table->text('direccion')->nullable();
            $table->string('cod_postal')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->boolean('usa_transporte')->default(false);
            $table->string('cod_transporte')->nullable();
            $table->text('PIN')->nullable();
            $table->text('fotografia')->nullable();
            $table->boolean('asiste')->default(true);
            $table->string('email')->nullable();
            $table->string('facultad')->nullable();
            $table->integer('ano_ingreso')->nullable();
            $table->string('carrera')->nullable();
            $table->string('semestre')->nullable();
            $table->bigInteger('deporteini')->unsigned()->nullable();
            $table->date('fechaemipas')->nullable();
            $table->date('fechavenpas')->nullable();
            $table->text('lugaremipas')->nullable();
            $table->string('uniforme')->nullable();
            $table->double('calzado')->nullable();
            $table->double('peso')->nullable();
            $table->double('talla')->nullable();
            $table->integer('edad')->nullable();
            $table->text('image_cedula')->nullable();
            $table->integer('carnet_socio')->nullable();
            $table->bigInteger('id_tipo_socio')->unsigned()->nullable();
            $table->foreign('id_entidad')->references('id')->on('estados')->cascadeOnDelete();
            $table->foreign('id_entidad_responsable')->references('id')->on('users')->nullOnDelete();
            $table->foreign('id_cargo')->references('id')->on('cargos')->nullOnDelete();
            $table->foreign('status_acreditacion')->references('id')->on('status_acreditacion')->nullOnDelete();
            $table->foreign('cod_transporte')->references('transporte')->on('transporte')->nullOnDelete();
            $table->foreign('deporteini')->references('id')->on('deportes')->nullOnDelete();
            $table->foreign('id_tipo_socio')->references('id')->on('tipo_socio')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
