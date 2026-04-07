<?php

namespace App\Exports;

use App\Models\DeporteOficial;
use App\Models\ModalidadDeportiva;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class QuorumInscripcion implements FromView, WithTitle, ShouldAutoSize
{

    /**
     * @return View
     */
    public function view(): View
    {
        $deportes = ModalidadDeportiva::whereRelation('deporte', 'en_uso', 1)
            ->where('puntuable', 1)
            ->where('en_practica', 1)
            ->orderBy('id_deporte')->get();

        return \view('export.intencion-quorum-incripcion')
            ->with('i', 0)
            ->with('deportes', $deportes)
            ->with('totalFemenino', 0)
            ->with('totalMasculino', 0);
    }

    public function title(): string
    {
        return 'QUÓRUM';
    }
}
