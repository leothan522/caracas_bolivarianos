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
        //
        if (config('app.sql_participantes') && config('app.sql_datos_medicos')){
            \Illuminate\Support\Facades\DB::unprepared(
                file_get_contents(storage_path('app/private/sql/init_datos_medicos.sql'))
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
