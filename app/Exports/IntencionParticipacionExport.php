<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IntencionParticipacionExport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            new ResumenExport(),
            new QuorumExport()
        ];
    }
}
