<?php

namespace App\Livewire;

use App\Models\ModalidadDeportiva;
use App\Models\ParticipacionClub;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;

class IntencionTableComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $id_entidad;

    public function mount($id_entidad)
    {
        $this->id_entidad = $id_entidad;
    }

    public function render()
    {
        return view('livewire.intencion-table-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query = ModalidadDeportiva::query();
                return $query->whereRelation('deporte', 'en_uso', 1)
                    ->where('puntuable', 1)
                    ->where('en_practica', 1)
                    ->orderBy('id_deporte');
            })
            //->heading('id: ' . $this->id_entidad)
            ->columns([
                TextColumn::make('deporte.deporte')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('modalidad')
                    ->wrap()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('deporte')
                    ->relationship(
                        'deporte',
                        'deporte',
                        fn(Builder $query) => $query->where('en_uso', 1)->orderBy('id')
                    )
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Action::make('seleccionar')
                    //->icon('heroicon-m-check-circle')
                    //->icon('heroicon-o-stop')
                    ->icon(function (ModalidadDeportiva $record): string {
                        $icon = 'heroicon-o-stop';
                        $participacion = $this->getParticipacion($record->id);
                        if ($participacion && $participacion->intencion) {
                            $icon = 'heroicon-m-check-circle';
                        }
                        return $icon;
                    })
                    ->iconButton()
                    ->action(function (ModalidadDeportiva $record): void {
                        if ($this->id_entidad) {
                            $this->setParticipacion($record);
                            $this->dispatch('actualizarResultados');
                        } else {
                            Notification::make()
                                ->title('Falta Seleccionar CLUB')
                                ->warning()
                                ->color('warning')
                                ->persistent()
                                ->send();
                        }
                    })
            ], position: ActionsPosition::BeforeColumns);
    }

    #[On('cambiarValorEntidad')]
    public function setEntidad($id): void
    {
        $this->id_entidad = $id;
        $this->resetTable();
    }

    protected function getParticipacion($id_modalidad): ?ParticipacionClub
    {
        return ParticipacionClub::where('id_entidad', $this->id_entidad)
            ->where('id_modalidad', $id_modalidad)
            ->first();
    }

    protected function setParticipacion($record): void
    {
        $intencion = 0;
        $participacion = $this->getParticipacion($record->id);
        if ($participacion) {
            $intencion = $participacion->intencion;
        } else {
            $participacion = new ParticipacionClub();
            $participacion->id_entidad = $this->id_entidad;
            $participacion->id_deporte = $record->id_deporte;
            $participacion->id_modalidad = $record->id;
        }
        $participacion->intencion = $intencion ? 0 : 1;
        $participacion->save();
    }

}
