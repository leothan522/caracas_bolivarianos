<?php

namespace App\Traits;

use App\Models\DeporteOficial;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

trait DeportesTrait
{
    public bool $intencion = true;
    public static bool $intencionParticipacion = true;

    public static int|null $id_entidad = null;
    public static string|null $nombre_entidad = null;

    protected function subHeader(): ?string
    {
        $response = null;
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        if ($id_nivel == 1 || $is_root) {
            $ver = $this->intencion ? 'INTENCION_DEPORTE_VER' : 'NUMERICA_DEPORTE_VER';
            $hasta = $this->intencion ? 'INTENCION_DEPORTE_HASTA' : 'NUMERICA_DEPORTE_HASTA';
            if (verPage($ver, $hasta)) {
                $response = "Registro Activo";
            } else {
                $response = "Registro Inactivo";
            }
        }

        return $response;
    }

    protected function actionGenerarReporte(): array
    {
        $proceso = $this->intencion ? 1 : 2;
        return [
            Action::make('descargar_manuales')
                ->label('Descargar Manuales Técnicos')
                ->icon('heroicon-o-folder-arrow-down')
                ->color('info')
                ->action(function (){
                    $filePath = 'manuales/Manuales_COBOLJ_Caracas_2026_pdf.zip';
                    if (Storage::disk('public')->exists($filePath)){
                        return Storage::disk('public')->download($filePath);
                    }
                    Notification::make()
                        ->title('Error')
                        ->body('El archivo de manuales no se encuentra en el servidor.')
                        ->danger()
                        ->send();
                }),
            Action::make('generar_excel')
                ->label('Generar Reporte')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(route('excel-exports.intencion-participacion', $proceso))
                ->openUrlInNewTab()
                ->visible(fn(): bool => auth()->user()->id_nivel == 1 || auth()->user()->id_nivel == 6 || auth()->user()->is_root),
        ];
    }

    protected static function getQueryDeporteOficial(): Builder
    {
        $query = DeporteOficial::query();
        $query->where('proceso', self::getProceso());
        return $query->select('deportes_oficiales.*')
            ->join('deportes', 'deportes.id', '=', 'deportes_oficiales.id_deporte')
            ->orderBy('deportes.deporte')->orderBy('ordenar');
    }

    protected static function getProceso(): int
    {
        return self::$intencionParticipacion ? 1 : 2;
    }


}
