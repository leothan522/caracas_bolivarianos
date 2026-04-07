<?php

namespace App\Exports;

use App\Models\DeporteOficial;
use App\Models\Entidad;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ResumenExport implements FromView, WithTitle, ShouldAutoSize
{
    /**
     * @return View
     */
    public function view(): View
    {
        $deportes = DeporteOficial::select('deportes_oficiales.*')
            ->join('deportes', 'deportes.id', '=', 'deportes_oficiales.id_deporte')
            ->orderBy('deportes.deporte', 'asc')->orderBy('ordenar')->get();

        $clubes = Entidad::where('is_delegacion', 1)->where('activo', 1)->orderBy('short_nombre')->get();

        return \view('export.intencion-resumen')
            ->with('i', 0)
            ->with('deportes', $deportes)
            ->with('clubes', $clubes)
            ->with('totalFemenino', 0)
            ->with('totalMasculino', 0);
    }

    public function title(): string
    {
        return 'INTENCIÓN - NUMÉRICA';
    }

}
