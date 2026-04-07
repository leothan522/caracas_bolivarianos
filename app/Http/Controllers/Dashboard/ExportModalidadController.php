<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Atleta;
use App\Models\Deporte;
use App\Models\Entidad;
use App\Models\ModalidadDeportiva;
use App\Models\Participante;
use App\Traits\ReportesFpdf;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class ExportModalidadController extends Fpdf
{
    use ReportesFpdf;

    public function exportDeporte($id_entidad, $filtro, $id_deporte): mixed
    {
        if ($id_entidad != 'all'){
            return $this->generarPDFDeporte($id_entidad, $filtro, $id_deporte);
        }else{
            return  $this->generarAllPDFDeporte($filtro, $id_deporte);
        }
    }

    public function exportModalidad($id_entidad, $filtro, $id_modalidad): mixed
    {
        if ($id_entidad != 'all') {
            return $this->generarPDFModalidad($id_entidad, $filtro, $id_modalidad);
        } else {
            return $this->generarAllPDFModalidad($filtro, $id_modalidad);
        }
    }

    protected function generarPDFModalidad($id_entidad, $filtro, $id_modalidad): mixed
    {
        $_SESSION['headerTitle'] = 'Listado General de Inscritos';
        $name = "reporte_por_modalidad";
        $nameDeporte = '';
        $nameModalidad = '';
        $query = Atleta::query();

        $query->whereRelation('participante', 'id_entidad', $id_entidad);
        if ($filtro != 'all') {
            $query->whereRelation('participante', 'asiste', $filtro);
        }
        $query->where('id_modalidad', $id_modalidad);

        $atletas = $query->get();

        if ($atletas->isNotEmpty()) {

            $modalidad = ModalidadDeportiva::find($id_modalidad);
            $nameModalidad = "Modalidad : $modalidad->modalidad";
            $nameDeporte = $modalidad->deporte->deporte;

            $entidad = Entidad::find($id_entidad);
            $this->setClub($entidad->nombre);
            $_SESSION['footerClub'] = $entidad->nombre;

            $count = $atletas->count();
            if ($count < 10) {
                $total = cerosIzquierda($count, 2);
            } else {
                $total = formatoMillares($count, 0);
            }

            $pdf = new ExportModalidadController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(160, 10, $this->getClub(), 0, 0, 'C');
            $pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');

            $pdf->Cell(60, 10, $this->getDeporte($nameDeporte), 0, 0, 'C');
            $pdf->Cell(130, 10, $this->getTextoGenerico($nameModalidad), 0, 1, 'C');
            if ($filtro != 'all') {
                $texto = $filtro ? 'ASISTE' : 'NO ASISTE';
                $pdf->Cell(0, 10, "FILTRO : $texto", 0, 1, 'C');
            }
            $pdf->Ln(3);

            //Titulos de Columnas
            $pdf->SetFillColor(250, 152, 135);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->SetTextColor(0);
            $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
            $pdf->Cell(19, 7, verUtf8('Cédula'), 1, 0, 'C', 1);
            $pdf->Cell(40, 7, verUtf8('Nombres'), 1, 0, 'C', 1);
            $pdf->Cell(40, 7, verUtf8('Apellidos'), 1, 0, 'C', 1);
            $pdf->Cell(19, 7, verUtf8('Fecha Nac.'), 1, 0, 'C', 1);
            $pdf->Cell(25, 7, verUtf8('Cargo'), 1, 0, 'C', 1);
            $pdf->Cell(12, 7, verUtf8('Asiste'), 1, 0, 'C', 1);
            $pdf->Cell(25, 7, verUtf8('Tipo Socio'), 1, 1, 'C', 1);

            //filas
            $pdf->SetFont('Times', '', 9);
            $pdf->SetTextColor(0);
            $i = 0;
            foreach ($atletas as $atleta) {
                $participante = Participante::find($atleta->id_participante);
                if ($participante){
                    $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                    $pdf->Cell(19, 7, $this->getCedula($participante), 1, 0, 'C');
                    $pdf->Cell(40, 7, $this->getNombres($participante), 1);
                    $pdf->Cell(40, 7, $this->getApellidos($participante), 1);
                    $pdf->Cell(19, 7, $this->getFechaNac($participante), 1, 0, 'C');
                    $pdf->Cell(25, 7, $this->getCargo($participante), 1, 0, 'C');
                    $pdf->Cell(12, 7, $this->getAsiste($participante), 1, 0, 'C');
                    $pdf->Cell(25, 7, $this->getTipoSocio($participante), 1, 1, 'C');
                }
            }


            $pdf->Output('I', $name . '.pdf');
            return $pdf;

        } else {
            /*sweetAlert2([
                'icon' => 'info',
                'text' => 'Reporte Vacio',
                'timer' => null,
                'showCloseButton' => true
            ]);
            return redirect()->route('web.index');*/
            echo "<script type='text/javascript'>
                    alert('Reporte Vacio.');
                    window.close();</script>";
            return false;
        }

    }

    protected function generarAllPDFModalidad($filtro, $id_modalidad): mixed
    {
        $_SESSION['headerTitle'] = 'Listado General de Inscritos';
        $name = "reporte_por_modalidad";
        $nameDeporte = '';
        $nameModalidad = '';
        $query = Atleta::query();

        if ($filtro != 'all') {
            $query->whereRelation('participante', 'asiste', $filtro);
        }
        $query->where('id_modalidad', $id_modalidad);
        $query->withAggregate('participante', 'id_entidad');

        $atletas = $query->orderBy('participante_id_entidad')->get();

        if ($atletas->isNotEmpty()) {

            $modalidad = ModalidadDeportiva::find($id_modalidad);
            $nameModalidad = "Modalidad : $modalidad->modalidad";
            $nameDeporte = $modalidad->deporte->deporte;

            $this->setClub('REPORTE COMPLETO DE CLUBES');
            $_SESSION['footerClub'] = 'REPORTE COMPLETO DE CLUBES';

            $count = $atletas->count();
            if ($count < 10) {
                $total = cerosIzquierda($count, 2);
            } else {
                $total = formatoMillares($count, 0);
            }

            $pdf = new ExportModalidadController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(160, 10, $this->getClub(), 0, 0, 'C');
            $pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');

            $pdf->Cell(60, 10, $this->getDeporte($nameDeporte), 0, 0, 'C');
            $pdf->Cell(130, 10, $this->getTextoGenerico($nameModalidad), 0, 1, 'C');
            if ($filtro != 'all') {
                $texto = $filtro ? 'ASISTE' : 'NO ASISTE';
                $pdf->Cell(0, 10, "FILTRO : $texto", 0, 1, 'C');
            }
            $pdf->Ln(3);

            //Titulos de Columnas
            $pdf->SetFillColor(250, 152, 135);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->SetTextColor(0);
            $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
            $pdf->Cell(19, 7, verUtf8('Cédula'), 1, 0, 'C', 1);
            $pdf->Cell(25, 7, verUtf8('Nombres'), 1, 0, 'C', 1);
            $pdf->Cell(25, 7, verUtf8('Apellidos'), 1, 0, 'C', 1);
            $pdf->Cell(19, 7, verUtf8('Fecha Nac.'), 1, 0, 'C', 1);
            $pdf->Cell(25, 7, verUtf8('Cargo'), 1, 0, 'C', 1);
            $pdf->Cell(12, 7, verUtf8('Asiste'), 1, 0, 'C', 1);
            $pdf->Cell(25, 7, verUtf8('Tipo Socio'), 1, 0, 'C', 1);
            $pdf->Cell(30, 7, verUtf8('Club'), 1, 1, 'C', 1);

            //filas
            $pdf->SetFont('Times', '', 9);
            $pdf->SetTextColor(0);
            $i = 0;
            foreach ($atletas as $atleta) {
                $participante = Participante::find($atleta->id_participante);
                if ($participante){
                    $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                    $pdf->Cell(19, 7, $this->getCedula($participante), 1, 0, 'C');
                    $pdf->Cell(25, 7, $this->getPrimerNombre($participante, 10), 1);
                    $pdf->Cell(25, 7, $this->getPrimerApellido($participante, 10), 1);
                    $pdf->Cell(19, 7, $this->getFechaNac($participante), 1, 0, 'C');
                    $pdf->Cell(25, 7, $this->getCargo($participante), 1, 0, 'C');
                    $pdf->Cell(12, 7, $this->getAsiste($participante), 1, 0, 'C');
                    $pdf->Cell(25, 7, $this->getTipoSocio($participante), 1, 0, 'C');
                    $pdf->Cell(30, 7, $this->getNombreClub($participante, 14), 1, 1, 'C');
                }
            }


            $pdf->Output('I', $name . '.pdf');
            return $pdf;

        } else {
            /*sweetAlert2([
                'icon' => 'info',
                'text' => 'Reporte Vacio',
                'timer' => null,
                'showCloseButton' => true
            ]);
            return redirect()->route('web.index');*/
            echo "<script type='text/javascript'>
                    alert('Reporte Vacio.');
                    window.close();</script>";
            return false;
        }

    }

    protected function generarPDFDeporte($id_entidad, $filtro, $id_deporte):mixed
    {
        $_SESSION['headerTitle'] = 'Listado General de Inscritos';
        $name = "reporte_por_modalidad";
        $nameDeporte = '';
        $nameModalidad = '';

        $entidad = Entidad::find($id_entidad);
        $this->setClub($entidad->nombre);
        $_SESSION['footerClub'] = $entidad->nombre;

        $deporte = Deporte::find($id_deporte);
        $nameDeporte = $deporte->deporte;

        $listarModalidades = ModalidadDeportiva::where('id_deporte', $id_deporte)
            ->where('puntuable', 1)
            ->where('en_practica', 1)
            ->get();

        $query = Atleta::query();

        $query->whereRelation('participante', 'id_entidad', $id_entidad);
        if ($filtro != 'all') {
            $query->whereRelation('participante', 'asiste', $filtro);
        }
        $query->where('id_deporte', $id_deporte);

        $atletas = $query->get();

        if ($atletas->isNotEmpty()) {


            //********************************************************************************************************

            $pdf = new ExportModalidadController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(190, 10, $this->getClub(), 0, 1, 'C');
            //$pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');
            $pdf->Cell(0, 10, $this->getDeporte($nameDeporte), 0, 1, 'C');

            foreach ($listarModalidades as $modalidad){

                $modalidad = ModalidadDeportiva::find($modalidad->id);
                $nameModalidad = "Modalidad : $modalidad->modalidad";

                $query = Atleta::query();
                $query->whereRelation('participante', 'id_entidad', $id_entidad);
                if ($filtro != 'all') {
                    $query->whereRelation('participante', 'asiste', $filtro);
                }
                $query->where('id_modalidad', $modalidad->id);

                $atletas = $query->get();

                if ($atletas->isNotEmpty()) {
                    $pdf->Cell(130, 10, $this->getTextoGenerico($nameModalidad));
                    if ($filtro != 'all') {
                        $texto = $filtro ? 'ASISTE' : 'NO ASISTE';
                        $pdf->Cell(0, 10, "FILTRO : $texto", 0, 1, 'C');
                    }else{
                        $pdf->Cell(0, 10, '', 0, 1);
                    }
                    $pdf->Ln(3);

                    //Titulos de Columnas
                    $pdf->SetFillColor(250, 152, 135);
                    $pdf->SetFont('Times', 'B', 10);
                    $pdf->SetTextColor(0);
                    $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
                    $pdf->Cell(19, 7, verUtf8('Cédula'), 1, 0, 'C', 1);
                    $pdf->Cell(40, 7, verUtf8('Nombres'), 1, 0, 'C', 1);
                    $pdf->Cell(40, 7, verUtf8('Apellidos'), 1, 0, 'C', 1);
                    $pdf->Cell(19, 7, verUtf8('Fecha Nac.'), 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, verUtf8('Cargo'), 1, 0, 'C', 1);
                    $pdf->Cell(12, 7, verUtf8('Asiste'), 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, verUtf8('Tipo Socio'), 1, 1, 'C', 1);

                    //filas
                    $pdf->SetFont('Times', '', 9);
                    $pdf->SetTextColor(0);
                    $i = 0;
                    foreach ($atletas as $atleta) {
                        $participante = Participante::find($atleta->id_participante);
                        if ($participante){
                            $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                            $pdf->Cell(19, 7, $this->getCedula($participante), 1, 0, 'C');
                            $pdf->Cell(40, 7, $this->getNombres($participante), 1);
                            $pdf->Cell(40, 7, $this->getApellidos($participante), 1);
                            $pdf->Cell(19, 7, $this->getFechaNac($participante), 1, 0, 'C');
                            $pdf->Cell(25, 7, $this->getCargo($participante), 1, 0, 'C');
                            $pdf->Cell(12, 7, $this->getAsiste($participante), 1, 0, 'C');
                            $pdf->Cell(25, 7, $this->getTipoSocio($participante), 1, 1, 'C');
                        }
                    }
                    $pdf->Ln(5);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetTextColor(46, 57, 242);
                }
            }

            $pdf->Output('I', $name . '.pdf');
            return $pdf;

            //*******************************************************************************************************


        } else {
            /*sweetAlert2([
                'icon' => 'info',
                'text' => 'Reporte Vacio',
                'timer' => null,
                'showCloseButton' => true
            ]);
            return redirect()->route('web.index');*/
            echo "<script type='text/javascript'>
                    alert('Reporte Vacio.');
                    window.close();</script>";
            return false;
        }
    }

    protected function generarAllPDFDeporte($filtro, $id_deporte): mixed
    {
        $_SESSION['headerTitle'] = 'Listado General de Inscritos';
        $name = "reporte_por_modalidad";
        $nameDeporte = '';
        $nameModalidad = '';

        $this->setClub('REPORTE COMPLETO DE CLUBES');
        $_SESSION['footerClub'] = 'REPORTE COMPLETO DE CLUBES';

        $deporte = Deporte::find($id_deporte);
        $nameDeporte = $deporte->deporte;

        $listarModalidades = ModalidadDeportiva::where('id_deporte', $id_deporte)
            ->where('puntuable', 1)
            ->where('en_practica', 1)
            ->get();

        $query = Atleta::query();
        if ($filtro != 'all') {
            $query->whereRelation('participante', 'asiste', $filtro);
        }
        $query->where('id_deporte', $id_deporte);

        $atletas = $query->get();

        if ($atletas->isNotEmpty()) {


            //********************************************************************************************************

            $pdf = new ExportModalidadController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(190, 10, $this->getClub(), 0, 1, 'C');
            //$pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');
            $pdf->Cell(0, 10, $this->getDeporte($nameDeporte), 0, 1, 'C');

            foreach ($listarModalidades as $modalidad){

                $modalidad = ModalidadDeportiva::find($modalidad->id);
                $nameModalidad = "Modalidad : $modalidad->modalidad";

                $query = Atleta::query();
                if ($filtro != 'all') {
                    $query->whereRelation('participante', 'asiste', $filtro);
                }
                $query->where('id_modalidad', $modalidad->id);
                $query->withAggregate('participante', 'id_entidad');

                $atletas = $query->orderBy('participante_id_entidad')->get();

                if ($atletas->isNotEmpty()) {
                    $pdf->Cell(130, 10, $this->getTextoGenerico($nameModalidad));
                    if ($filtro != 'all') {
                        $texto = $filtro ? 'ASISTE' : 'NO ASISTE';
                        $pdf->Cell(0, 10, "FILTRO : $texto", 0, 1, 'C');
                    }else{
                        $pdf->Cell(0, 10, '', 0, 1);
                    }
                    $pdf->Ln(3);

                    //Titulos de Columnas
                    $pdf->SetFillColor(250, 152, 135);
                    $pdf->SetFont('Times', 'B', 10);
                    $pdf->SetTextColor(0);
                    $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
                    $pdf->Cell(19, 7, verUtf8('Cédula'), 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, verUtf8('Nombres'), 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, verUtf8('Apellidos'), 1, 0, 'C', 1);
                    $pdf->Cell(19, 7, verUtf8('Fecha Nac.'), 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, verUtf8('Cargo'), 1, 0, 'C', 1);
                    $pdf->Cell(12, 7, verUtf8('Asiste'), 1, 0, 'C', 1);
                    $pdf->Cell(25, 7, verUtf8('Tipo Socio'), 1, 0, 'C', 1);
                    $pdf->Cell(30, 7, verUtf8('Club'), 1, 1, 'C', 1);

                    //filas
                    $pdf->SetFont('Times', '', 9);
                    $pdf->SetTextColor(0);
                    $i = 0;
                    foreach ($atletas as $atleta) {
                        $participante = Participante::find($atleta->id_participante);
                        if ($participante){
                            $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                            $pdf->Cell(19, 7, $this->getCedula($participante), 1, 0, 'C');
                            $pdf->Cell(25, 7, $this->getPrimerNombre($participante, 10), 1);
                            $pdf->Cell(25, 7, $this->getPrimerApellido($participante, 10), 1);
                            $pdf->Cell(19, 7, $this->getFechaNac($participante), 1, 0, 'C');
                            $pdf->Cell(25, 7, $this->getCargo($participante), 1, 0, 'C');
                            $pdf->Cell(12, 7, $this->getAsiste($participante), 1, 0, 'C');
                            $pdf->Cell(25, 7, $this->getTipoSocio($participante), 1, 0, 'C');
                            $pdf->Cell(30, 7, $this->getNombreClub($participante, 14), 1, 1, 'C');
                        }
                    }
                    $pdf->Ln(5);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetTextColor(46, 57, 242);
                }
            }

            $pdf->Output('I', $name . '.pdf');
            return $pdf;

            //*******************************************************************************************************


        } else {
            /*sweetAlert2([
                'icon' => 'info',
                'text' => 'Reporte Vacio',
                'timer' => null,
                'showCloseButton' => true
            ]);
            return redirect()->route('web.index');*/
            echo "<script type='text/javascript'>
                    alert('Reporte Vacio.');
                    window.close();</script>";
            return false;
        }
    }

}
