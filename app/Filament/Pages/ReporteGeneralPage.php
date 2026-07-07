<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ReporteGeneralPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reporte-general-page';
    protected static ?string $title = 'Reporte General';
    protected static ?string $navigationGroup = 'Reportes';

    public static function canAccess(): bool
    {
        return false;
    }

}
