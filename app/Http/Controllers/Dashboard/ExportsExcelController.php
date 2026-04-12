<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\InscripcionNumericaExport;
use App\Exports\IntencionParticipacionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class ExportsExcelController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function intencionParticipacion($proceso = 1)
    {
        $filename = $proceso == 1 ? 'RESUMEN_INTENCION_PARTICIPACION' : 'RESUMEN_INSCRIPCION_NUMERICA';
        return Excel::download(new IntencionParticipacionExport($proceso), $filename.'.xlsx');
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function inscripcionNumerica()
    {
        return Excel::download(new InscripcionNumericaExport(), 'RESUMEN_INSCRIPCION_NUMERICA.xlsx');
    }
}
