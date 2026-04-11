<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class IntencionDeportesPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.intencion-deportes-page';
    protected static ?string $title = 'OLD->Intención de Participación';

    public static function canAccess(): bool
    {
        return false;
    }

    public function getSubheading(): string|Htmlable|null
    {
        $response = null;
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        if ($id_nivel == 1 || $is_root) {
            if (verPage('INTENCION_DEPORTE_VER', 'INTENCION_DEPORTE_HASTA')) {
                $response = "Registro Activo";
            } else {
                $response = "Registro Inactivo";
            }
        }

        return $response;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generar_excel')
                ->label('Generar Reporte')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(route('excel-exports.intencion-participacion'))
                ->openUrlInNewTab()
                ->visible(fn(): bool => auth()->user()->id_nivel == 1 || auth()->user()->is_root),
        ];
    }

}
