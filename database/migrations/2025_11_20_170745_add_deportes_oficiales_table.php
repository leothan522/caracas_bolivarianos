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
        Schema::table('deportes_oficiales', function (Blueprint $table) {
            $table->integer('ordenar')->nullable()->after('id_deporte');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deportes_oficiales', function (Blueprint $table) {
            //
        });
    }
};
