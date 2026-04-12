<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DeporteOficial;
use App\Models\Entidad;
use App\Models\ParticipacionDisciplina;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExportIntencionDeporteController extends Fpdf
{
    public bool $intencion = true;

    public function exportIntencionDeporte($proceso, $id_entidad = null): mixed
    {
        $entidad = Entidad::find($id_entidad);
        if ($entidad){

            //definimos variables
            $nameFile = $proceso == 1 ? 'Intencion_participacion_club' : 'Inscripcion_numerica_club';
            $nombreClub = Str::upper(verUtf8($entidad->codigoe.' - '.$entidad->nombre));
            $ciudadClub = Str::upper(verUtf8($entidad->short_nombre));
            $_SESSION['nombreClub'] = Str::upper(verUtf8($entidad->nombre));

            //iniciamos el PDF
            $pdf = new ExportIntencionDeporteController();
            if ($proceso != 1){
                $pdf->intencion = false;
            }
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            $altura = 5;

            //Cabecera
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(47, $altura + 3, verUtf8('PAÍS PARTICIPANTE:'), 1, 0, 'C');
            $pdf->Cell(143, $altura + 3, $nombreClub, 1, 1, 'C');
            /*$pdf->Cell(40, $altura, 'CIUDAD DEL CLUB:', 1);
            $pdf->Cell(150, $altura, $ciudadClub, 1, 1, 'C');*/
            $pdf->Ln(5);

            //Titulos de Columnas
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, $altura, 'DEPORTES OFICIALES', 1, 1, 'C');


            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(30,$altura * 2, verUtf8('DISCIPLINAS'), 1, 0, 'C');
            $pdf->Cell(36,$altura * 2, verUtf8('CATEGORÍAS'), 1, 0, 'C');
            $pdf->Cell(94, $altura, 'CONDICIONES DE LA DISCIPLINA', 1, 0, 'C');

            $pdf->SetFont('Times', 'B', 7);

            $pdf->Cell(30, $altura, 'ATLETAS A INSCRIBIR', 1, 1, 'C');

            $pdf->Cell(30, $altura, '');
            $pdf->Cell(36, $altura, '');
            $pdf->Cell(8, $altura, verUtf8('Min'), 1, 0, 'C');
            $pdf->Cell(8, $altura, verUtf8('Max'), 1, 0, 'C');
            $pdf->Cell(28, $altura, verUtf8('GÉNERO'), 1, 0, 'C');
            $pdf->Cell(20, $altura, verUtf8('EDADES'), 1, 0, 'C');
            $pdf->Cell(30, $altura, verUtf8('FECHA CALENDARIO'), 1, 0, 'C');
            $pdf->Cell(10, $altura, verUtf8('Masc'), 1, 0, 'C');
            $pdf->Cell(10, $altura, verUtf8('Fem'), 1, 0, 'C');
            $pdf->Cell(10, $altura, verUtf8('TOTAL'), 1, 1, 'C');


            //filas
            $deportes = DeporteOficial::select('deportes_oficiales.*')
                ->join('deportes', 'deportes.id', '=', 'deportes_oficiales.id_deporte')
                ->orderBy('deportes.deporte', 'asc')->orderBy('ordenar', 'asc')->get();
            $totalMasculino = 0;
            $totalFemenino = 0;
            $totalGeneral = 0;

            //$altura = 5;
            foreach ($deportes as $deporte){

                if ($deporte->proceso != $proceso){
                    continue;
                }

                $pdf->SetFont('Times', '', 8);
                $pdf->SetTextColor(0);

                $pdf->Cell(30, $altura, verUtf8($deporte->deporte->deporte), 1, 0, 'C');
                $pdf->Cell(36, $altura, verUtf8($deporte->categoria), 1, 0, 'C');
                $pdf->Cell(8, $altura, verUtf8($deporte->min), 1, 0, 'C');
                $pdf->Cell(8, $altura, verUtf8($deporte->max), 1, 0, 'C');
                $pdf->Cell(28, $altura, verUtf8($deporte->genero), 1, 0, 'C');

                if ($deporte->edad_libre){
                    $pdf->Cell(20, $altura, verUtf8('LIBRE'), 1, 0, 'C');
                }else{
                    $pdf->Cell(7, $altura, verUtf8(is_numeric($deporte->edad_inicial) ? $deporte->edad_inicial : '>='), 1, 0, 'C');
                    $pdf->Cell(6, $altura, verUtf8('a'), 1, 0, 'C');
                    $pdf->Cell(7, $altura, verUtf8($deporte->edad_final), 1, 0, 'C');
                }

                if ($deporte->fecha_libre){
                    $pdf->Cell(30, $altura, verUtf8('LIBRE'), 1, 0, 'C');
                }else{
                    $pdf->Cell(10, $altura, verUtf8($deporte->fecha_inicial), 1, 0, 'C');
                    if (is_numeric($deporte->fecha_final)){
                        $pdf->Cell(10, $altura, verUtf8('al'), 1, 0, 'C');
                        $pdf->Cell(10, $altura, verUtf8($deporte->fecha_final), 1, 0, 'C');
                    }else{
                        $pdf->Cell(20, $altura, verUtf8('hacia abajo'), 1, 0, 'C');
                    }
                }

                $femenino = '';
                $masculino = '';
                $total = '';

                $intencion = ParticipacionDisciplina::where('proceso', $proceso)->where('id_deporte_oficial', $deporte->id)->where('id_entidad', $entidad->id)->first();
                if ($intencion){
                    $femenino = $intencion->femenino ?? 0;
                    $masculino = $intencion->masculino ?? 0;
                    $total = $intencion->femenino + $intencion->masculino;

                    $totalFemenino = $totalFemenino + $femenino;
                    $totalMasculino = $totalMasculino + $masculino;
                    $totalGeneral = $totalGeneral + $total;
                }

                $pdf->Cell(10, $altura, verUtf8($masculino), 1, 0, 'C');
                $pdf->Cell(10, $altura, verUtf8($femenino), 1, 0, 'C');
                $pdf->SetFont('Times', 'B', 8);
                $pdf->Cell(10, $altura, verUtf8($total), 1, 1, 'C');

            }
            $pdf->Ln(3);

            //total general

            $pdf->SetFont('Times', 'B', 10);

            $pdf->Cell(110, ($altura * 2) + 2, '', 1, 0, 'C');
            $pdf->Cell(50, $altura, 'TOTAL GENERAL', 0, 0, 'C');
            $pdf->Cell(10, $altura, verUtf8($totalMasculino), 1, 0, 'C');
            $pdf->Cell(10, $altura, verUtf8($totalFemenino), 1, 0, 'C');
            $pdf->Cell(10, $altura, verUtf8($totalGeneral), 1, 1, 'C');
            $pdf->Ln(7);
            $pdf->Cell(0, $altura, verUtf8('JEFE DE MISIÓN'), 0, 1);


            //Exportamos el PDF
            $pdf->Output('I', $nameFile . '.pdf');
            return $pdf;

        }else{
            echo "<script type='text/javascript'>
                    alert('Reporte Vacio.');
                    window.close();</script>";
            return false;
        }
    }

    function Header(): void
    {
        // Logo
        $this->Image(asset('img/Imagen1.png'), 10, 10, 20, 25);
        $this->Image(asset('img/Imagen1.png'), 180, 10, 20, 25);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 10);
        // Movernos hacia abajo
        $this->SetY(12);
        //membrete
        $this->Cell(0, 7, verUtf8('II JUEGOS BOLIVARIANOS DE LA JUVENTUD "CARACAS 2026"'), 0, 1, 'C');
        $this->Cell(0, 7, verUtf8('DEPORTES - MODALIDADES'), 0, 1, 'C');
        //titulo
        $this->SetFont('Arial', 'B', 15);
        $label = $this->intencion ? 'PLANILLA DE INTENCIÓN DE PARTICIPACIÓN 2026' : 'PLANILLA DE INSCRIPCIÓN NUMÉRICA 2026';
        $this->Cell(0, 10, verUtf8($label), 0, 1, 'C');
        // Salto de línea
        $this->Ln(5);
    }

    // Pie de página
    function Footer(): void
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 7);
        $this->SetTextColor(0);
        //Nombre club
        $this->Cell(160, 10, verUtf8(Str::upper(verUtf8($_SESSION['nombreClub']).'   /   Fecha impreso: '.getFecha(now()))));
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, verUtf8('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }
}
