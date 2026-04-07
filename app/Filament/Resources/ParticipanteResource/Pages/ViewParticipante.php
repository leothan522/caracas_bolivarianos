<?php

namespace App\Filament\Resources\ParticipanteResource\Pages;

use App\Filament\Resources\ParticipanteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewParticipante extends ViewRecord
{
    protected static string $resource = ParticipanteResource::class;

    public function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make()
                ->before(fn($record) => $record->update(['cedula' => '*' . $record->cedula])),
        ];
    }
}
