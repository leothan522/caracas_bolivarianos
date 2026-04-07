<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Atleta;
use App\Models\Participante;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function consultarParticipante($cedula)
    {
        $participante = Participante::where('cedula', $cedula)->first();
        if (!$participante){
            sweetAlert2([
                'icon' => 'info',
                'text' => 'Participante NO encontrado',
                'timer' => null,
                'showCloseButton' => true
            ]);
            return redirect()->route('web.index');
        }

        $deportes = Atleta::where('id_participante', $participante->id)->orderBy('id_deporte')->get();

        return view('web.consultar')
            ->with('participante', $participante)
            ->with('deportes', $deportes);
    }
}
