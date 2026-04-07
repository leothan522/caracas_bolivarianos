<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InscripcionNumericaExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new ResumenInscripcion(),
            new QuorumInscripcion()
        ];
    }
}
