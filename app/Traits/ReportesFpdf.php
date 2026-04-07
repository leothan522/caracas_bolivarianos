<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ReportesFpdf
{
    public string $nombreClub;

    // Cabecera de página
    function Header(): void
    {
        // Logo
        $this->Image(asset('img/cintillo.png'), 10, 0);
        $this->Image(asset('img/logo_juegos.png'), 170, 5, 30, 30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos hacia abajo
        $this->SetY(12);
        // Movernos a la derecha
        $this->Cell(30);
        // Name APP
        $this->SetTextColor(255);
        $this->Cell(43, 10, env('APP_NAME', 'Morros Devops'), 0, 0, 'C');
        $this->Cell(12);
        // Título
        $this->SetTextColor(0);
        $this->Cell(70, 10, $_SESSION['headerTitle'], 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
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
        $this->Cell(160, 10, verUtf8(Str::upper(/*'Club: '.*/$_SESSION['footerClub'].'   /   Fecha: '.getFecha(now()))));
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, verUtf8('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'R');
    }

    protected function setClub($nombre): void
    {
        $this->nombreClub = $nombre;
    }

    protected function getClub(): string
    {
        return verUtf8(Str::upper(/*'CLUB: '.*/$this->nombreClub));
    }

    protected function getTotal($total): string
    {
        return Str::upper('Total: '.$total);
    }

    protected function getDeporte($nameDeporte): string
    {
        return Str::upper('Deporte: '.$nameDeporte);
    }

    protected function getCedula($participante): string
    {
        $cedula = $participante->cedula;
        if (is_numeric($participante->cedula)){
            $cedula = formatoMillares($participante->cedula, 0);
        }
        return Str::limit(Str::padLeft(Str::upper($cedula), 10), 12, preserveWords: true);
    }

    protected function getNombres($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->primer_nombre.' '.$participante->segundo_nombre),19));
    }

    protected function getPrimerNombre($participante, $limit = 20): string
    {
        return verUtf8(Str::limit(Str::upper($participante->primer_nombre), $limit));
    }

    protected function getSegundoNombre($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->segundo_nombre ?? ''),20));
    }

    protected function getApellidos($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->primer_apellido.' '.$participante->segundo_apellido),19));
    }

    protected function getPrimerApellido($participante, $limit = 20): string
    {
        return verUtf8(Str::limit(Str::upper($participante->primer_apellido), $limit));
    }

    protected function getSegundoApellido($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->segundo_apellido ?? ''),20));
    }

    protected function getFechaNac($participante): string
    {
        if (!empty($participante->fecha_nacimiento)){
            return getFecha($participante->fecha_nacimiento);
        }
        return '';
    }

    protected function getCargo($participante, int $limit = 12): string
    {
        return verUtf8(Str::limit(Str::upper($participante->cargo->cargo), $limit, preserveWords: true));
    }

    protected function getCarnet($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->carnet_socio ?? ''), 15));
    }

    protected function getTipoSocio($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->tipoSocio->tipo_socio ?? ''), 15));
    }

    protected function getSexo($paticipante): string
    {
        $opciones =[
            0 => 'Masculino',
            1 => 'Femenino'
        ];
        return verUtf8(Str::upper($opciones[$paticipante->sexo] ?? ''));
    }

    protected function getEmail($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->email ?? ''),20));
    }

    protected function getTelefono($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->telefono ?? ''),20));
    }

    protected function getDeporteParticipante($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->deporteinicial->deporte ?? ''),20));
    }

    protected function getRH($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->rh ?? ''),42));
    }

    protected function getAlergias($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->alergias ?? ''),48));
    }

    protected function getAntecedentes($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->antecedentes ?? ''),48));
    }

    protected function getEsAlergico($participante): string
    {
        return verUtf8($participante->alergico ? 'SI' : 'NO');
    }

    protected function getAntmedicos($participante): string
    {
        return verUtf8($participante->ant_medicos ? 'SI' : 'NO');
    }

    protected function getAvisarA($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->avisar_a ?? ''),35));
    }

    protected function getTelefonoMedico($participante): string
    {
        return verUtf8(Str::limit(Str::upper($participante->telefono_medico ?? ''),48));
    }

    protected function getModalidad($atleta, int $i): string
    {
        return verUtf8(Str::limit(Str::upper($i.'.- '.$atleta->deporte->deporte .' - '.$atleta->modalidad->modalidad),45));
    }

    protected function getAsiste($participante): string
    {
        return verUtf8($participante->asiste ? 'SI' : 'NO');
    }

    protected function getNombreClub($participante, int $limit = 12): string
    {
        return verUtf8(Str::limit(Str::upper($participante->entidad->short_nombre ?? ''), $limit));
    }

    protected function getTextoGenerico($texto, int $limit = 100): string
    {
        return verUtf8(Str::limit(Str::upper($texto ?? ''), $limit));
    }

}
