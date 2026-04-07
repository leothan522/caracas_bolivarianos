<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ReporteModalidadPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reporte-modalidad-page';
    protected static ?string $title = 'Inscritos por Modalidad';
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return false;
    }

}
