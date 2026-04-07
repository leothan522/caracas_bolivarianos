<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Atleta;
use App\Models\Participante;
use App\Traits\ReportesFpdf;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Str;

class ExportParticipanteController extends Fpdf
{
    use ReportesFpdf;

    public function generarPDF($id): mixed
    {
        $participante = Participante::find($id);
        if (!$participante) {
            sweetAlert2([
                'icon' => 'info',
                'text' => 'Participante NO encontrado',
                'timer' => null,
                'showCloseButton' => true
            ]);
            return redirect()->route('web.index');
        }

        $name = 'Participante CI ' . $participante->cedula;
        $_SESSION['headerTitle'] = "Ficha del Participante";
        $this->setClub($participante->entidad->nombre);
        $_SESSION['footerClub'] = $this->getClub();

        $pdf = new ExportParticipanteController();
        $pdf->SetTitle('viewPDF');
        $pdf->AliasNbPages();
        $pdf->AddPage();

        //Cabecera
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(46, 57, 242);
        $pdf->Cell(0, 10, $this->getClub(), 0, 1, 'C');
        $pdf->Ln(3);

        //Imagen de Perfil
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        for ($i = 1; $i <= 5; $i++) {
            $pdf->Cell(50, 10, '', 0, 1);
        }

        $pdf->SetFillColor(46, 119, 195);
        $pdf->Rect($x, $y, 50, 49);
        $pdf->Image(verImagen($participante->fotografia, true), $x + 1, $y + 1, 48, 47);

        $pdf->SetY($y);
        $pdf->SetX(61);

        //Datos Personales
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->SetFillColor(250, 152, 135);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetTextColor(0);

        //$pdf->Cell(139, 7, '', 1, 1);
        $pdf->Cell(0, 7, verUtf8(Str::upper('Datos Personales')), 1, 1, 'C', 1);

        $pdf->SetX($x);
        $pdf->Cell(15, 7, verUtf8('Cédula:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(31, 7, $this->getCedula($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(15, 7, verUtf8('Carnet:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(32, 7, $this->getCarnet($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(18, 7, verUtf8('Tipo Socio:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(28, 7, $this->getTipoSocio($participante));
        $pdf->SetX($x);
        $pdf->Cell(0, 7, '', 1, 1);

        $pdf->SetX($x);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('P. Nombre:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(51, 7, $this->getPrimerNombre($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('S. Nombre:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(48, 7, $this->getSegundoNombre($participante));
        $pdf->SetX($x);
        $pdf->Cell(0, 7, '', 1, 1);

        $pdf->SetX($x);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('P. Apellido:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(51, 7, $this->getPrimerApellido($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('S. Apellido:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(48, 7, $this->getSegundoApellido($participante));
        $pdf->SetX($x);
        $pdf->Cell(0, 7, '', 1, 1);

        $pdf->SetX($x);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('Sexo:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(51, 7, $this->getSexo($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('Fecha Nac:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(48, 7, $this->getFechaNac($participante));
        $pdf->SetX($x);
        $pdf->Cell(0, 7, '', 1, 1);

        $pdf->SetX($x);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('Email:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(51, 7, $this->getEmail($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('Teléfono:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(48, 7, $this->getTelefono($participante));
        $pdf->SetX($x);
        $pdf->Cell(0, 7, '', 1, 1);

        $pdf->SetX($x);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('Deporte:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(51, 7, $this->getDeporteParticipante($participante));
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(20, 7, verUtf8('Cargo:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(48, 7, $this->getCargo($participante, 20));
        $pdf->SetX($x);
        $pdf->Cell(0, 7, '', 1, 1);

        $pdf->Ln(10);

        //Datos medicos
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetFont('Times', 'B', 10);

        $pdf->Cell(139, 7, verUtf8(Str::upper('Datos Médicos')), 1, 0, 'C', 1);
        $pdf->Cell(51, 7, verUtf8(Str::upper('Foto del Carnet')), 1, 1, 'C', 1);

        $pdf->Cell(39, 7, verUtf8('Grupo Sanguineo y RH:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(100, 7, $this->getRH($participante));
        $x2 = $pdf->GetX();
        $y2 = $pdf->GetY();
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(23, 7, verUtf8('Es alérgico:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(116, 7, $this->getEsAlergico($participante));
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(23, 7, verUtf8('Alergias:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(116, 7, $this->getAlergias($participante));
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(23, 7, verUtf8('Ant. Médicos:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(116, 7, $this->getAntmedicos($participante));
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(23, 7, verUtf8('Antecedentes:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(116, 7, $this->getAntecedentes($participante));
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(51, 7, verUtf8('En caso de emergencia avisar a:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(88, 7, $this->getAvisarA($participante));
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(23, 7, verUtf8('Teléfono:'));
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(116, 7, $this->getTelefonoMedico($participante));
        $pdf->SetX($x);
        $pdf->Cell(139, 7, '', 1, 1);

        //Foto del Carnet
        $pdf->Rect($x2, $y2, 51, 49);
        $pdf->Image(verImagen($participante->image_cedula), $x2 + 1, $y2 + 0.5, 49, 48);

        $pdf->Ln(10);

        //Deportes y Modalidades

        $deportes = Atleta::where('id_participante', $participante->id)->orderBy('id_deporte')->get();
        if ($deportes->isNotEmpty()){

            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(95, 7, verUtf8(Str::upper('Deportes y Modalidades')), 1, 1, 'C', 1);

            $pdf->SetFont('Times', '', 10);
            $i = 0;
            foreach ($deportes as $atleta){
                $pdf->Cell(95, 7, $this->getModalidad($atleta, ++$i));
                $pdf->SetX($x);
                $pdf->Cell(95, 7, '', 1, 1);
            }

        }else{
            if ($participante->id_cargo == 4){

                $pdf->SetFont('Times', 'B', 10);
                $pdf->Cell(95, 7, verUtf8(Str::upper('Deportes y Modalidades')), 1, 1, 'C', 1);
                $pdf->SetFont('Times', '', 10);
                for ($i = 1; $i <= 1; $i++ ){
                    $pdf->Cell(95, 7, verUtf8($i.'.-'));
                    $pdf->SetX($x);
                    $pdf->Cell(95, 7, '', 1, 1);
                }
            }
        }

        // Code QR
        $pdf->SetY(-42);
        $y = $pdf->GetY();
        $pdf->Image(qrCodeGenerateFPDF(route('consultar.participante', $participante->cedula)), 175, $y, 25, 25);


        $pdf->Output('I', $name . '.pdf');

        return $pdf;
    }

}
