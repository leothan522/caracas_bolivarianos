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
        Schema::table('participantes', function (Blueprint $table) {
            //
            $table->string('rh')->nullable()->after('id_tipo_socio');
            $table->boolean('alergico')->default(false)->after('RH');
            $table->boolean('ant_medicos')->default(false)->after('alergico');
            $table->string('alergias')->nullable()->after('ant_medicos');
            $table->text('antecedentes')->nullable()->after('alergias');
            $table->string('avisar_a')->nullable()->after('antecedentes');
            $table->string('telefono_medico')->nullable()->after('avisar_a');
            $table->text('obs_medicas')->nullable()->after('telefono');
        });

        $rows = \App\Models\Participante::all();
        foreach ($rows as $row) {
            $datos = \App\Models\DatoMedico::where('cedula', $row->cedula)->first();
            if ($datos) {
                $row->rh = $datos->RH;
                $row->alergico = $datos->alergico;
                $row->ant_medicos = $datos->ant_medicos;
                $row->alergias = $datos->alergias;
                $row->antecedentes = $datos->antecedentes;
                $row->avisar_a = $datos->avisar_a;
                $row->telefono_medico = $datos->telefono;
                $row->obs_medicas = $datos->obs;
                $row->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participantes', function (Blueprint $table) {
            //
        });
    }
};
