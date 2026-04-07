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
        if (config('app.sql_extra')){
            \Illuminate\Support\Facades\DB::unprepared(
                file_get_contents(storage_path('app/private/sql/init_zonas_acceso.sql'))
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
