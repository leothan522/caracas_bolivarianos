<?php

namespace App\Filament\Resources\ParticipanteResource\Pages;

use App\Filament\Resources\ParticipanteResource;
use App\Models\Participante;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\Attributes\On;

class EditParticipante extends EditRecord
{
    protected static string $resource = ParticipanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Imprimir')
                ->label('Imprimir')
                ->url(fn(Participante $record) => route('export.participante', $record->getKey()))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ParticipanteResource\Widgets\ModalidadDeportivaWidget::class,
        ];
    }

    protected function beforeSave(): void
    {
        // Runs before the form fields are saved to the database.
        $this->dispatch('updatePage');
    }

}
