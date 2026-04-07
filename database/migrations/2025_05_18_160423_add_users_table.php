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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('id_entidad')->unsigned()->nullable()->after('profile_photo_path');
            $table->bigInteger('id_nivel')->unsigned()->nullable()->after('id_entidad');
            $table->boolean('activo')->default(true)->after('id_nivel');
            $table->integer('visitas')->default(0)->after('activo');
            $table->string('descripcion')->nullable()->after('visitas');
            $table->string('telefono')->nullable()->after('descripcion');
            $table->foreign('id_entidad')->references('id')->on('estados')->nullOnDelete();
            $table->foreign('id_nivel')->references('id')->on('niveles')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
