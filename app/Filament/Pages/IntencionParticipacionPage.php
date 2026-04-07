<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class IntencionParticipacionPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.intencion-participacion-page';
    protected static ?string $title = "Intención de Participación";

    public static function canAccess(): bool
    {
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        return verPage('INTENCION_VER', 'INTENCION_HASTA') ||
            (!verPage('INTENCION_DEPORTE_VER', 'INTENCION_DEPORTE_HASTA') && ($id_nivel == 1 || $is_root));
    }

    public function getSubheading(): string|Htmlable|null
    {
        $response = null;
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        if ($id_nivel == 1 || $is_root){
            if (verPage('INTENCION_VER', 'INTENCION_HASTA')){
                $response = "Registro Activo";
            }else{
                $response = "Registro Inactivo";
            }
        }

        return $response;
    }

}
