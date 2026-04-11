<?php

namespace App\Filament\Resources\IntencionParticipacionResource\Pages;

use App\Filament\Resources\IntencionParticipacionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManageIntencionParticipacions extends ManageRecords
{
    protected static string $resource = IntencionParticipacionResource::class;

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
