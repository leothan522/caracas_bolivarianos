<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InscripcionNumericaResource\Pages;
use App\Models\DeporteOficial;
use App\Traits\DeportesTrait;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InscripcionNumericaResource extends Resource
{
    use DeportesTrait;

    protected static ?string $model = DeporteOficial::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Inscripción Numérica';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Inscripción Numérica';

    protected static ?string $pluralModelLabel = 'Inscripción Numérica';

    protected static ?string $slug = 'inscripcion-numerica';

    public static function table(Table $table): Table
    {
        self::$intencionParticipacion = false;
        return IntencionParticipacionResource::table($table, self::$intencionParticipacion);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageInscripcionNumericas::route('/'),
        ];
    }

    public static function canAccess(): bool
    {
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        return verPage('NUMERICA_DEPORTE_VER', 'NUMERICA_DEPORTE_HASTA') ||
            (!verPage('NUMERICA_VER', 'NUMERICA_HASTA') && ($id_nivel == 1 || $is_root));
    }
}
