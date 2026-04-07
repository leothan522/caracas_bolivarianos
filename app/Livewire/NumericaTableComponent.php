<?php

namespace App\Livewire;

use App\Models\ModalidadDeportiva;
use App\Models\ParticipacionClub;
use Filament\Forms\Components\Fieldset;
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

class NumericaTableComponent extends Component implements HasForms, HasTable
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
        return view('livewire.numerica-table-component');
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
                TextColumn::make('Femenino')
                    ->default(fn(ModalidadDeportiva $record): mixed => $this->getNumeros($record->id))
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('Masculino')
                    ->default(fn(ModalidadDeportiva $record): mixed => $this->getNumeros($record->id, false))
                    ->numeric()
                    ->alignEnd(),
                TextColumn::make('Total')
                    ->default(fn(ModalidadDeportiva $record): mixed => $this->getNumeros($record->id) + $this->getNumeros($record->id, false))
                    ->numeric()
                    ->alignEnd(),
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
                Action::make('editar')
                    ->icon('heroicon-m-pencil-square')
                    ->fillForm(fn(ModalidadDeportiva $record): array => $this->getNumerica($record->id))
                    ->form([
                        Fieldset::make('Atleta')
                            ->schema([
                                TextInput::make('num_atl_fem')
                                    ->label('Femenino')
                                    ->numeric(),
                                TextInput::make('num_atl_mas')
                                    ->label('Masculino')
                                    ->numeric(),
                            ]),
                        Fieldset::make('Entrenador')
                            ->schema([
                                TextInput::make('num_ent_fem')
                                    ->label('Femenino')
                                    ->numeric(),
                                TextInput::make('num_ent_mas')
                                    ->label('Masculino')
                                    ->numeric(),
                            ]),
                        Fieldset::make('Delegado')
                            ->schema([
                                TextInput::make('num_del_fem')
                                    ->label('Femenino')
                                    ->numeric(),
                                TextInput::make('num_del_mas')
                                    ->label('Masculino')
                                    ->numeric(),
                            ]),
                        Fieldset::make('Arbitro')
                            ->schema([
                                TextInput::make('num_arb_fem')
                                    ->label('Femenino')
                                    ->numeric(),
                                TextInput::make('num_arb_mas')
                                    ->label('Masculino')
                                    ->numeric(),
                            ]),
                        Fieldset::make('Oficiales')
                            ->schema([
                                TextInput::make('num_ofi_fem')
                                    ->label('Femenino')
                                    ->numeric(),
                                TextInput::make('num_ofi_mas')
                                    ->label('Masculino')
                                    ->numeric(),
                            ]),

                    ])
                    ->action(fn(array $data, ModalidadDeportiva $record) => $this->setParticipacion($record, $data))
                    ->modalHeading(fn(ModalidadDeportiva $record): string => $record->deporte->deporte)
                    ->modalDescription(fn(ModalidadDeportiva $record): string => $record->modalidad)
                    ->modalWidth(MaxWidth::Medium)
                    ->disabled(!isset($this->id_entidad)),
            ]);
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

    protected function getNumerica($id_modalidad): array
    {
        $data = [];
        $participacion = $this->getParticipacion($id_modalidad);
        if ($participacion){
            $data = [
                'num_atl_fem' => $participacion->num_atl_fem,
                'num_atl_mas' => $participacion->num_atl_mas,
                'num_ent_fem' => $participacion->num_ent_fem,
                'num_ent_mas' => $participacion->num_ent_mas,
                'num_del_fem' => $participacion->num_del_fem,
                'num_del_mas' => $participacion->num_del_mas,
                'num_arb_fem' => $participacion->num_arb_fem,
                'num_arb_mas' => $participacion->num_arb_mas,
                'num_ofi_fem' => $participacion->num_ofi_fem,
                'num_ofi_mas' => $participacion->num_ofi_mas,
            ];
        }
        return $data;
    }

    protected function setParticipacion($record, $data): void
    {
        $participacion = $this->getParticipacion($record->id);
        if (!$participacion) {
            $participacion = new ParticipacionClub();
            $participacion->id_entidad = $this->id_entidad;
            $participacion->id_deporte = $record->id_deporte;
            $participacion->id_modalidad = $record->id;
        }
        $participacion->num_atl_fem = $data['num_atl_fem'];
        $participacion->num_atl_mas = $data['num_atl_mas'];
        $participacion->num_ent_fem = $data['num_ent_fem'];
        $participacion->num_ent_mas = $data['num_ent_mas'];
        $participacion->num_del_fem = $data['num_del_fem'];
        $participacion->num_del_mas = $data['num_del_mas'];
        $participacion->num_arb_fem = $data['num_arb_fem'];
        $participacion->num_arb_mas = $data['num_arb_mas'];
        $participacion->num_ofi_fem = $data['num_ofi_fem'];
        $participacion->num_ofi_mas = $data['num_ofi_mas'];
        $participacion->num_total_fem = $data['num_atl_fem'] + $data['num_ent_fem'] + $data['num_del_fem'] + $data['num_arb_fem'] + $data['num_ofi_fem'];
        $participacion->num_total_mas = $data['num_atl_mas'] + $data['num_ent_mas'] + $data['num_del_mas'] + $data['num_arb_mas'] + $data['num_ofi_mas'];
        $participacion->num_total = array_sum($data);
        $participacion->save();
    }

    protected function getNumeros($id_modalidad, $femenino = true): mixed
    {
        $num = 0;
        if ($this->id_entidad){
            $participacion = $this->getParticipacion($id_modalidad);
            if ($femenino){
                $num = $participacion->num_atl_fem ?? 0;
            }else{
                $num = $participacion->num_atl_mas ?? 0;
            }
        }else{
            $participacion = ParticipacionClub::where('id_modalidad', $id_modalidad)->get();
            if ($participacion){
                if ($femenino){
                    $num = $participacion->sum('num_atl_fem');
                }else{
                    $num = $participacion->sum('num_atl_mas');
                }
            }
        }
        return $num;
    }

}
