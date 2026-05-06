<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Storage;

class DownloadManualsWidget extends Widget
{
    protected static string $view = 'filament.widgets.download-manuals-widget';

    protected static bool $isLazy = false;

    public function download()
    {
        $filePath = 'manuales/Manuales_COBOLJ_Caracas_2026_pdf.zip';
        if (Storage::disk('public')->exists($filePath)){
            return Storage::disk('public')->download($filePath);
        }
        $this->dispatch('notify', [
            'status' => 'danger',
            'message' => 'El archivo no se encuentra disponible.',
        ]);
        return false;
    }
}
