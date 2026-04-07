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
        Schema::create('prensa', function (Blueprint $table) {
            $table->id();
            $table->string('cedula');
            $table->bigInteger('id_medio')->unsigned();
            $table->integer('certificado')->nullable();
            $table->integer('cpn')->nullable();
            $table->string('descrip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prensa');
    }
};
