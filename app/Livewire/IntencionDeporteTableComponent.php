<?php

namespace App\Livewire;

use App\Models\DeporteOficial;
use App\Models\ParticipacionDisciplina;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Support\Enums\MaxWidth;
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

class IntencionDeporteTableComponent extends Component implements HasForms, HasTable
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
        return view('livewire.intencion-deporte-table-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query = DeporteOficial::query();
                return $query->select('deportes_oficiales.*')
                    ->join('deportes', 'deportes.id', '=', 'deportes_oficiales.id_deporte')
                    ->orderBy('deportes.deporte', 'asc')->orderBy('ordenar', 'asc');
            })
            ->columns([
                TextColumn::make('deporte_sm')
                    ->label('Deporte')
                    ->default(fn(DeporteOficial $record) => $record->deporte->deporte ?? null)
                    ->description(fn(DeporteOficial $record) => $record->genero)
                    ->hiddenFrom('md'),
                TextColumn::make('deporte.deporte')
                    ->searchable()
                    ->wrap()
                    ->visibleFrom('md'),
                TextColumn::make('categoria')
                    ->description(function (DeporteOficial $record): string {
                        $response = "";

                        if (!$record->edad_libre) {
                            $response = "($record->edad_inicial a $record->edad_final)";
                        }

                        return $response;
                    })
                    ->searchable()
                    ->wrap()
                    ->alignCenter(),
                TextColumn::make('min')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('max')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('genero')
                    ->alignCenter()
                    ->visibleFrom('md'),
            ])
            ->filters([
                SelectFilter::make('deporte')
                    ->relationship(
                        'deporte',
                        'deporte',
                        fn(Builder $query) => $query->has('oficiales'),
                    )
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Action::make('seleccionar')
                    ->iconButton()
                    ->icon(function (DeporteOficial $record): string {
                        $response = 'heroicon-o-stop';
                        if ($this->getParticipacion($record)) {
                            $response = 'heroicon-m-check-circle';
                        }
                        return $response;
                    })
                    ->modalHeading(fn(DeporteOficial $record): string => $record->deporte->deporte ?? null)
                    ->modalDescription(fn(DeporteOficial $record): string => $record->categoria)
                    ->modalWidth(MaxWidth::Small)
                    ->fillForm(function (DeporteOficial $record): array {
                        $response = [];
                        $intencion = $this->getParticipacion($record);
                        if ($intencion) {
                            $response = [
                                'femenino' => $intencion->femenino,
                                'masculino' => $intencion->masculino
                            ];
                        }
                        return $response;
                    })
                    ->form([
                        TextInput::make('femenino')
                            ->integer()
                            ->minValue(0),
                        TextInput::make('masculino')
                            ->integer()
                            ->minValue(0),
                    ])
                    ->action(function (array $data, DeporteOficial $record): void {
                        if ($this->id_entidad) {
                            $intencion = $this->getParticipacion($record);
                            if ($data['femenino'] || $data['masculino']) {
                                if (!$intencion) {
                                    $intencion = new ParticipacionDisciplina();
                                    $intencion->id_entidad = $this->id_entidad;
                                    $intencion->id_deporte_oficial = $record->id;
                                }
                                $intencion->femenino = $data['femenino'];
                                $intencion->masculino = $data['masculino'];
                                $intencion->save();
                            } else {
                                $intencion?->delete();
                            }
                        } else {
                            Notification::make()
                                ->title('Falta Seleccionar CLUB')
                                ->warning()
                                ->color('warning')
                                ->persistent()
                                ->send();
                        }
                    }),
            ], position: ActionsPosition::BeforeColumns);
    }

    protected function getParticipacion($record): ?ParticipacionDisciplina
    {
        return ParticipacionDisciplina::where('id_entidad', $this->id_entidad)
            ->where('id_deporte_oficial', $record->id)
            ->first();
    }

    #[On('cambiarValorEntidad')]
    public function setEntidad($id): void
    {
        $this->id_entidad = $id;
        $this->resetTable();
    }

}
