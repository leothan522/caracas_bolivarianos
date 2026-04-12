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
        Schema::table('participacion_intencion_disciplinas', function (Blueprint $table) {
            $table->integer('proceso')->default(1)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participacion_intencion_disciplinas', function (Blueprint $table) {
            //
        });
    }
};
