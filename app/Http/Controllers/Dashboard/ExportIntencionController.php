<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Deporte;
use App\Models\Entidad;
use App\Models\ModalidadDeportiva;
use App\Models\ParticipacionClub;
use App\Models\Participante;
use App\Traits\ReportesFpdf;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExportIntencionController extends Fpdf
{
    use ReportesFpdf;

    public function exportIntencionParticipacion($id_entidad = null): mixed
    {
        $_SESSION['headerTitle'] = verUtf8('Intención de Participación');
        $name = 'Intencion_participacion_club';
        $nameDeporte = '';
        $query = ParticipacionClub::query();

        if (is_null($id_entidad)) {
            $id_entidad = auth()->user()->id_entidad;
        }

        $query->where('id_entidad', $id_entidad)
            ->where('intencion', 1);

        $participantes = $query->orderBy('id_deporte')->get();

        if ($participantes->isNotEmpty()) {

            $entidad = Entidad::find($id_entidad);
            $this->setClub($entidad->nombre);
            $_SESSION['footerClub'] = $entidad->nombre;
            $count = $participantes->count();
            if ($count < 10) {
                $total = cerosIzquierda($count, 2);
            } else {
                $total = formatoMillares($count, 0);
            }

            $pdf = new ExportIntencionController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(160, 10, $this->getClub(), 0, 0, 'C');
            $pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');
            $pdf->Ln(3);

            //Titulos de Columnas
            $pdf->SetFillColor(250, 152, 135);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->SetTextColor(0);
            $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
            $pdf->Cell(60, 7, verUtf8('Deporte'), 1, 0, 'C', 1);
            $pdf->Cell(0, 7, verUtf8('Modalidad'), 1, 1, 'C', 1);

            //filas
            $pdf->SetFont('Times', '', 9);
            $pdf->SetTextColor(0);
            $i = 0;
            foreach ($participantes as $participante) {
                $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                $pdf->Cell(60, 7, $this->getTextoGenerico($participante->deporte->deporte, 27), 1, 0, 'C');
                $pdf->Cell(0, 7, $this->getTextoGenerico($participante->modalidad->modalidad), 1, 1, 'C');
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

    public function exportIntencionReporteGeneral(): mixed
    {
        $_SESSION['headerTitle'] = verUtf8('Intención de Participación');
        $name = 'Intencion_participacion_reporte_general';
        $nameDeporte = '';
        $query = ModalidadDeportiva::query();

        $query->whereRelation('participacion', 'intencion', 1)
            ->withCount([
                'participacion' => fn(Builder $query) => $query->where('intencion', 1)
            ]);

        $participantes = $query->orderBy('participacion_count', 'DESC')->get();

        if ($participantes->isNotEmpty()) {

            //$entidad = Entidad::find($id_entidad);
            $this->setClub('Reporte General');
            $_SESSION['footerClub'] = 'Reporte General';
            $count = $participantes->count();
            if ($count < 10) {
                $total = cerosIzquierda($count, 2);
            } else {
                $total = formatoMillares($count, 0);
            }

            $pdf = new ExportIntencionController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(0, 10, $this->getClub(), 0, 1, 'C');
            //$pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');
            $pdf->Ln(3);

            //Titulos de Columnas
            $pdf->SetFillColor(250, 152, 135);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->SetTextColor(0);
            $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
            $pdf->Cell(60, 7, verUtf8('Deporte'), 1, 0, 'C', 1);
            $pdf->Cell(100, 7, verUtf8('Modalidad'), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8('Clubes'), 1, 1, 'C', 1);

            //filas
            $pdf->SetFont('Times', '', 9);
            $pdf->SetTextColor(0);
            $i = 0;
            foreach ($participantes as $participante) {
                $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                $pdf->Cell(60, 7, $this->getTextoGenerico($participante->deporte->deporte, 27), 1, 0, 'C');
                $pdf->Cell(100, 7, $this->getTextoGenerico($participante->modalidad), 1, 0, 'C');
                $pdf->Cell(20, 7, $this->getTextoGenerico($participante->participacion_count), 1, 1, 'C');
            }
            $pdf->Ln(5);

            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(0, 10, 'REPORTE POR DEPORTE Y MODALIDAD', 0, 1, 'C');
            //$pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');
            $pdf->Ln(3);

            foreach ($participantes as $participante) {
                $query = ParticipacionClub::query();
                $clubes = $query->where('id_modalidad', $participante->id)
                    ->where('intencion', 1)
                    ->get();

                //Titulos de Columnas
                $pdf->SetFillColor(250, 152, 135);
                $pdf->SetFont('Times', 'B', 10);
                $pdf->SetTextColor(0);
                $pdf->Cell(10, 7, verUtf8('#'), 1, 0, 'C', 1);
                $pdf->Cell(0, 7, verUtf8('Clubes con Intención Deporte: '.Str::upper($participante->deporte->deporte).' Modalidad: '.Str::upper($participante->modalidad)), 1, 1, 'C', 1);

                //filas
                $pdf->SetFont('Times', '', 9);
                $pdf->SetTextColor(0);
                $i = 0;
                foreach ($clubes as $club){
                    $pdf->Cell(10, 7, ++$i, 1, 0, 'C');
                    $pdf->Cell(0, 7, $this->getTextoGenerico($club->entidad->nombre), 1, 1, 'C');
                }
                $pdf->Ln(5);
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

    public function exportIntencionNumerica($id_entidad = null): mixed
    {
        $_SESSION['headerTitle'] = verUtf8('Inscripción Numérica');
        $name = 'inscripcion_numerica_reporte_general';
        $nameDeporte = '';
        $query = ModalidadDeportiva::query();

        $query->whereRelation('deporte', 'en_uso', 1)
            ->where('puntuable', 1)
            ->where('en_practica', 1);

        $participantes = $query->orderBy('id_deporte')->get();

        if ($participantes->isNotEmpty()) {

            $club = 'Reporte General';
            if ($id_entidad){
                $entidad = Entidad::find($id_entidad);
                if ($entidad){
                    $club = $entidad->nombre;
                }
            }
            $this->setClub($club);
            $_SESSION['footerClub'] = $club;

            $pdf = new ExportIntencionController();
            $pdf->SetTitle('viewPDF');
            $pdf->AliasNbPages();
            $pdf->AddPage();

            //Cabecera
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(46, 57, 242);
            $pdf->Cell(0, 10, $this->getClub(), 0, 1, 'C');
            //$pdf->Cell(30, 10, $this->getTotal($total), 0, 1, 'C');
            $pdf->Ln(3);

            //Titulos de Columnas
            $pdf->SetFillColor(250, 152, 135);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->SetTextColor(0);
            $pdf->Cell(10, 14, verUtf8('#'), 1, 0, 'C', 1);
            $pdf->Cell(60, 14, verUtf8('Deporte y Modalidad'), 1, 0, 'C', 1);
            $x = $pdf->GetX();
            $pdf->Cell(20, 7, verUtf8('Atleta'), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8('Entrenador'), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8('Delegado'), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8('Arbitro'), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8('Oficiales'), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8('Total'), 1, 1, 'C', 1);

            $pdf->SetX($x);
            $pdf->Cell(10, 7, verUtf8('FEM'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('MAS'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('FEM'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('MAS'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('FEM'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('MAS'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('FEM'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('MAS'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('FEM'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('MAS'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('FEM'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8('MAS'), 1, 1, 'C', 1);

            //filas
            $pdf->SetFont('Times', '', 9);
            $pdf->SetTextColor(0);
            $i = 0;
            $total_atleta_fem = 0;
            $total_atleta_mas = 0;
            $total_entrenador_fem = 0;
            $total_entrenador_mas = 0;
            $total_delegado_fem = 0;
            $total_delegado_mas = 0;
            $total_arbitro_fem = 0;
            $total_arbitro_mas = 0;
            $total_oficiales_fem = 0;
            $total_oficiales_mas = 0;
            $total_total_fem = 0;
            $total_total_mas = 0;
            foreach ($participantes as $participante) {

                $data = $this->getNumeros($id_entidad, $participante->id);
                $atleta_fem = !is_null($data['num_atl_fem']) ? formatoMillares($data['num_atl_fem'], 0) : '';
                $atleta_mas = !is_null($data['num_atl_mas']) ? formatoMillares($data['num_atl_mas'], 0) : '';
                $entrenador_fem = !is_null($data['num_ent_fem']) ? formatoMillares($data['num_ent_fem'], 0) : '';
                $entrenador_mas = !is_null($data['num_ent_mas']) ? formatoMillares($data['num_ent_mas'], 0) : '';
                $delegado_fem = !is_null($data['num_del_fem']) ? formatoMillares($data['num_del_fem'], 0) : '';
                $delegado_mas = !is_null($data['num_del_mas']) ? formatoMillares($data['num_del_mas'], 0) : '';
                $arbitro_fem = !is_null($data['num_arb_fem']) ? formatoMillares($data['num_arb_fem'], 0) : '';
                $arbitro_mas = !is_null($data['num_arb_mas']) ? formatoMillares($data['num_arb_mas'], 0) : '';
                $oficiales_fem = !is_null($data['num_ofi_fem']) ? formatoMillares($data['num_ofi_fem'], 0) : '';
                $oficiales_mas = !is_null($data['num_ofi_mas']) ? formatoMillares($data['num_ofi_mas'], 0) : '';
                $total_fem = !is_null($data['num_total_fem']) ? formatoMillares($data['num_total_fem'], 0) : '';
                $total_mas = !is_null($data['num_total_mas']) ? formatoMillares($data['num_total_mas'], 0) : '';

                $total_atleta_fem = $total_atleta_fem + intval($data['num_atl_fem']);
                $total_atleta_mas = $total_atleta_mas + intval($data['num_atl_mas']);
                $total_entrenador_fem = $total_entrenador_fem + intval($data['num_ent_fem']);
                $total_entrenador_mas = $total_entrenador_mas + intval($data['num_ent_mas']);
                $total_delegado_fem = $total_delegado_fem + intval($data['num_del_fem']);
                $total_delegado_mas = $total_delegado_mas + intval($data['num_del_mas']);
                $total_arbitro_fem = $total_arbitro_fem + intval($data['num_arb_fem']);
                $total_arbitro_mas = $total_arbitro_mas + intval($data['num_arb_mas']);
                $total_oficiales_fem = $total_oficiales_fem + intval($data['num_ofi_fem']);
                $total_oficiales_mas = $total_oficiales_mas + intval($data['num_ofi_mas']);
                $total_total_fem = $total_total_fem + intval($data['num_total_fem']);
                $total_total_mas = $total_total_mas + intval($data['num_total_mas']);

                if ($id_entidad &&
                    is_null($data['num_atl_fem']) &&
                    is_null($data['num_atl_mas']) &&
                    is_null($data['num_ent_fem']) &&
                    is_null($data['num_ent_mas']) &&
                    is_null($data['num_del_fem']) &&
                    is_null($data['num_del_mas']) &&
                    is_null($data['num_arb_fem']) &&
                    is_null($data['num_arb_mas']) &&
                    is_null($data['num_ofi_fem']) &&
                    is_null($data['num_ofi_mas']) //&&
                ){
                    continue;
                }

                $y = $pdf->GetY();
                $pdf->Cell(10, 14, ++$i, 1, 0, 'C');
                $x1 = $pdf->GetX();
                $pdf->Cell(60, 7, $this->getTextoGenerico($participante->deporte->deporte, 27), 0, 1);
                $pdf->Cell(10, 7, '', 0, 0, 'C');
                $pdf->Cell(60, 7, $this->getTextoGenerico($participante->modalidad, 29), 0, 1);
                $pdf->SetXY($x, $y);
                $pdf->Cell(10, 14, verUtf8($atleta_fem), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($atleta_mas), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($entrenador_fem), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($entrenador_mas), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($delegado_fem), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($delegado_mas), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($arbitro_fem), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($arbitro_mas), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($oficiales_fem), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($oficiales_mas), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($total_fem), 1, 0, 'C');
                $pdf->Cell(10, 14, verUtf8($total_mas), 1, 1, 'C');
                $y1 = $pdf->GetY();
                $pdf->Line($x1, $y1, $x1 + 60, $y1);
            }

            $pdf->Cell(70, 14, verUtf8('TOTALES'), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_atleta_fem, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_atleta_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_entrenador_fem, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_entrenador_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_delegado_fem, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_delegado_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_arbitro_fem, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_arbitro_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_oficiales_fem, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_oficiales_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_total_fem, 0)), 1, 0, 'C', 1);
            $pdf->Cell(10, 7, verUtf8(formatoMillares($total_total_mas, 0)), 1, 1, 'C', 1);

            $pdf->Cell(70, 7);
            $pdf->Cell(20, 7, verUtf8(formatoMillares($total_atleta_fem + $total_atleta_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8(formatoMillares($total_entrenador_fem + $total_entrenador_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8(formatoMillares($total_delegado_fem + $total_delegado_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8(formatoMillares($total_arbitro_fem + $total_arbitro_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8(formatoMillares($total_oficiales_fem + $total_oficiales_mas, 0)), 1, 0, 'C', 1);
            $pdf->Cell(20, 7, verUtf8(formatoMillares($total_total_fem + $total_total_mas, 0)), 1, 1, 'C', 1);



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

    protected function getNumeros($id_entidad, $id_modalidad): array
    {
        $data = [
            'num_atl_fem' => null,
            'num_atl_mas' => null,
            'num_ent_fem' => null,
            'num_ent_mas' => null,
            'num_del_fem' => null,
            'num_del_mas' => null,
            'num_arb_fem' => null,
            'num_arb_mas' => null,
            'num_ofi_fem' => null,
            'num_ofi_mas' => null,
            'num_total_fem' => null,
            'num_total_mas' => null,
        ];
        if ($id_entidad){
            $participacion = ParticipacionClub::where('id_entidad', $id_entidad)
                ->where('id_modalidad', $id_modalidad)
                ->first();
            if ($participacion){
                $data = [
                    'num_atl_fem' => $participacion->num_atl_fem ?? 0,
                    'num_atl_mas' => $participacion->num_atl_mas ?? 0,
                    'num_ent_fem' => $participacion->num_ent_fem ?? 0,
                    'num_ent_mas' => $participacion->num_ent_mas ?? 0,
                    'num_del_fem' => $participacion->num_del_fem ?? 0,
                    'num_del_mas' => $participacion->num_del_mas ?? 0,
                    'num_arb_fem' => $participacion->num_arb_fem ?? 0,
                    'num_arb_mas' => $participacion->num_arb_mas ?? 0,
                    'num_ofi_fem' => $participacion->num_ofi_fem ?? 0,
                    'num_ofi_mas' => $participacion->num_ofi_mas ?? 0,
                    'num_total_fem' => $participacion->num_total_fem ?? 0,
                    'num_total_mas' => $participacion->num_total_mas ?? 0,
                ];
            }
        }else{
            $participacion = ParticipacionClub::where('id_modalidad', $id_modalidad)->get();
            if ($participacion->isNotEmpty()){
                $data = [
                    'num_atl_fem' => $participacion->sum('num_atl_fem'),
                    'num_atl_mas' => $participacion->sum('num_atl_mas'),
                    'num_ent_fem' => $participacion->sum('num_ent_fem'),
                    'num_ent_mas' => $participacion->sum('num_ent_mas'),
                    'num_del_fem' => $participacion->sum('num_del_fem'),
                    'num_del_mas' => $participacion->sum('num_del_mas'),
                    'num_arb_fem' => $participacion->sum('num_arb_fem'),
                    'num_arb_mas' => $participacion->sum('num_arb_mas'),
                    'num_ofi_fem' => $participacion->sum('num_ofi_fem'),
                    'num_ofi_mas' => $participacion->sum('num_ofi_mas'),
                    'num_total_fem' => $participacion->sum('num_total_fem'),
                    'num_total_mas' => $participacion->sum('num_total_mas'),
                ];
            }
        }

        return $data;
    }
}
