<?php

namespace App\Livewire;

use App\Models\Participante;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use function Laravel\Prompts\text;

class ReporteGeneralTableComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public bool $filtrar_entidad;
    public int $id_entidad;
    public string $texto;
    public int $id_deporte;

    public function mount(bool $filtrar_entidad, int $id_entidad, string $texto)
    {
        $this->filtrar_entidad = $filtrar_entidad;
        $this->id_entidad = $id_entidad;
        $this->texto = $texto;
    }

    public function render()
    {
        return view('livewire.reporte-general-table-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Participante::query())
            ->modifyQueryUsing(function (Builder $query) {
                if ($this->filtrar_entidad) {
                    $query->where('id_entidad', $this->id_entidad);
                }
                if ($this->id_deporte){
                    $query->where('deporteini', $this->id_deporte);
                }
                $query->whereRelation('deporteinicial', 'en_uso', 1);
                return $query;
            })
            ->columns([
                TextColumn::make('cedula')
                    ->numeric(),
                TextColumn::make('primer_nombre')
                    ->label('Nombre Completo')
                    ->formatStateUsing(function ($state, Participante $participante) {
                        return mb_strtoupper($participante->primer_nombre . ' ' . $participante->segundo_nombre . ' ' . $participante->primer_apellido . ' ' . $participante->segundo_apellido);
                    })
                    ->wrap(),
                TextColumn::make('fecha_nacimiento')
                    ->date('d/m/Y')
                    ->visibleFrom('sm')
                    ->alignEnd(),
                TextColumn::make('cargo.cargo')
                    ->label('Cargo')
                    ->formatStateUsing(fn(string $state) => mb_strtoupper($state))
                    ->wrap()
                    ->visibleFrom('sm'),
                TextColumn::make('entidad.short_nombre')
                    ->label('Club')
                    ->formatStateUsing(fn(string $state) => mb_strtoupper($state))
                    ->wrap()
                    ->hidden(function () {
                        $id_nivel = auth()->user()->id_nivel;
                        $is_root = auth()->user()->is_root;
                        if ($id_nivel != 1 && !$is_root) {
                            return true;
                        }
                        return false;
                    })
                    ->visibleFrom('sm'),
            ])
            ->filters([
                SelectFilter::make('id_entidad')
                    ->label('Club')
                    ->relationship('entidad', 'short_nombre')
                    ->hidden(function () {
                        $id_nivel = auth()->user()->id_nivel;
                        $is_root = auth()->user()->is_root;
                        if ($id_nivel != 1 && !$is_root) {
                            return true;
                        }
                        return false;
                    }),
            ])
            ->queryStringIdentifier($this->texto);
    }


}
