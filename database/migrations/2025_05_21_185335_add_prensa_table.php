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
        Schema::table('prensa', function (Blueprint $table) {
            //
            $table->bigInteger('id_participante')->unsigned()->nullable()->after('id');
            $table->foreign('id_participante')->references('id')->on('participantes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prensa', function (Blueprint $table) {
            //
        });
    }
};
