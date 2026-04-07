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
        Schema::table('datos_medicos', function (Blueprint $table) {
            //
            $table->bigInteger('id_participante')->unsigned()->nullable()->after('id');
            $table->foreign('id_participante')->references('id')->on('participantes')->cascadeOnDelete();
        });

        $rows = \App\Models\DatoMedico::all();
        foreach ($rows as $row) {
            $participante = \App\Models\Participante::where('cedula', $row->cedula)->first();
            if ($participante) {
                $row->id_participante = $participante->id;
                $row->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datos_medicos', function (Blueprint $table) {
            //
        });
    }
};
