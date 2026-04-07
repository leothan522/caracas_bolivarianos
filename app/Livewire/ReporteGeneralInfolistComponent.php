<?php

namespace App\Livewire;

use App\Models\Entidad;
use App\Models\Participante;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Str;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class ReporteGeneralInfolistComponent extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public string $title = 'Listado General de Inscritos';
    public int $id_deporte = 0;
    public bool $cerrado = false;
    public string $texto = 'general';

    public int $unico = 1;

    public function mount(string $title = '', int $id_deporte = 0)
    {
        if (!empty($title)) {
            $this->title = $title;
        }
        if ($id_deporte) {
            $this->id_deporte = $id_deporte;
            $this->cerrado = true;
            $this->texto = 'deporte' . $id_deporte;
        }
    }


    public function render()
    {
        return view('livewire.reporte-general-infolist-component');
    }

    public function reportesInfoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([])
            ->schema([
                Section::make($this->title)
                    ->description(fn(): string => 'Inscritos ' . cerosIzquierda($this->getInscritos()))
                    ->schema([
                        Livewire::make(ReporteGeneralTableComponent::class, [
                            'filtrar_entidad' => $this->filtrarEntidad(),
                            'id_entidad' => auth()->user()->id_entidad ?? 0,
                            'id_deporte' => $this->id_deporte,
                            'texto' => $this->texto
                        ]),
                    ])
                    ->headerActions([
                        Action::make('imprimir')
                            ->label('Generar PDF')
                            ->url(function (): string {
                                $response = route('export.reportes', 'all');
                                if ($this->id_deporte) {
                                    $response = route('export.reportes', ['all', $this->id_deporte]);
                                }
                                return $response;
                            })
                            ->openUrlInNewTab()
                            ->hidden(!$this->getInscritos() || !$this->filtrarEntidad())
                            ->disabled(!$this->getInscritos() || !$this->filtrarEntidad()),
                        Action::make('imprimir_entidad')
                            ->label('Generar PDF')
                            ->form([
                                Select::make('id_entidad')
                                    ->label(Str::upper('Club'))
                                    ->options(function (): array{
                                        $options = Entidad::query()->pluck('short_nombre', 'id')->toArray();
                                        $options['all'] = "TODOS";
                                        return $options;
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Select::make('filtro')
                                    ->options([
                                        'all' => 'TODOS',
                                        1 => 'ASISTE',
                                        0 => 'NO ASISTE'
                                    ])
                                    ->default('all')
                                    ->required(),
                            ])
                            ->modalWidth(MaxWidth::Small)
                            ->action(function (Component $livewire, array $data) {
                                if ($data['id_entidad'] != 'all'){
                                    $url = route('export.reportes.entidad', [$data['filtro'], $data['id_entidad']]);
                                    if ($this->id_deporte) {
                                        $url = route('export.reportes.entidad', [$data['filtro'], $data['id_entidad'], $this->id_deporte]);
                                    }
                                }else{
                                    $url = route('export.reportes.all', $data['filtro']);
                                    if ($this->id_deporte) {
                                        $url = route('export.reportes.all', [$data['filtro'], $this->id_deporte]);
                                    }
                                }
                                return $livewire->dispatch('generarpdfentidad-' . $this->id_deporte, url: $url);
                                //$this->unico = ++$this->unico;
                            })
                            ->hidden(!$this->getInscritos() || $this->filtrarEntidad())
                            ->disabled(!$this->getInscritos() || $this->filtrarEntidad()),
                    ])
                    ->compact()
                    ->collapsed($this->cerrado)
                    ->collapsible($this->cerrado)
                    ->extraAttributes(function () {
                        return [
                            'x-on:generarpdfentidad-' . $this->id_deporte . '.window' => 'window.open(event.detail.url)',
                        ];
                    }),
            ]);
    }

    protected function filtrarEntidad(): bool
    {
        $response = false;
        $id_nivel = auth()->user()->id_nivel;
        $is_root = auth()->user()->is_root;
        if ($id_nivel != 1 && !$is_root) {
            $response = true;
        }
        return $response;
    }

    protected function getInscritos(): int
    {
        $participantes = Participante::query();
        if ($this->id_deporte) {
            $participantes->where('deporteini', $this->id_deporte);
        }
        $id_nivel = auth()->user()->id_nivel;
        $id_entidad = auth()->user()->id_entidad;
        $is_root = auth()->user()->is_root;
        if ($id_nivel != 1 && !$is_root) {
            $participantes->where('id_entidad', $id_entidad);
        }
        $participantes->whereRelation('deporteinicial', 'en_uso', 1);
        return $participantes->count();
    }

}
