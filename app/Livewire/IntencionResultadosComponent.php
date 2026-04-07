<?php

namespace App\Livewire;

use App\Models\ModalidadDeportiva;
use App\Models\ParticipacionClub;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;

class IntencionResultadosComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function render()
    {
        return view('livewire.intencion-resultados-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query = ModalidadDeportiva::query();
                return $query->whereRelation('participacion', 'intencion', 1);
            })
            ->columns([
                TextColumn::make('deporte.deporte')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('modalidad')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('participacion_count')
                    ->label('Clubes')
                    ->counts([
                        'participacion' => fn(Builder $query) => $query->where('intencion', 1),
                    ])
                    ->numeric()
                    ->alignEnd()
                ->sortable(),
            ])
            ->defaultSort('participacion_count', 'desc')
            ->emptyStateHeading('No se han Registrados Intenciones');
    }

    #[On('actualizarResultados')]
    public function actualizar(): void
    {
        $this->resetTable();
    }
}
