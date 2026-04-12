<?php

namespace App\Filament\Resources\InscripcionNumericaResource\Pages;

use App\Filament\Resources\InscripcionNumericaResource;
use App\Traits\DeportesTrait;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManageInscripcionNumericas extends ManageRecords
{
    use DeportesTrait;

    protected static string $resource = InscripcionNumericaResource::class;

    protected function getHeaderActions(): array
    {
        $this->intencion = false;
        return $this->actionGenerarReporte();
    }

    public function getSubheading(): string|Htmlable|null
    {
        $this->intencion = false;
        return $this->subHeader();
    }
}
