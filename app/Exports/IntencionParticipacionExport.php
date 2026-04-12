<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class IntencionParticipacionExport implements WithMultipleSheets
{
    public int $proceso;
    public function __construct($proceso)
    {
        $this->proceso = $proceso;
    }

    public function sheets(): array
    {
        return [
            new ResumenExport($this->proceso),
            new QuorumExport($this->proceso)
        ];
    }
}
