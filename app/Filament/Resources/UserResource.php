<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Usuarios';
    protected static ?string $label = 'Usuarios';

    protected static ?string $navigationGroup = "Configuración";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos Básicos')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->required()
                            ->maxLength(255)
                            ->revealable()
                            ->hiddenOn('edit'),
                        Forms\Components\TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->maxLength(255)
                            ->default(null),
                        Forms\Components\TextInput::make('descripcion')
                            ->label('Descripción')
                            ->default(null),
                    ])
                    ->columns()
                    ->compact(),
                Forms\Components\Section::make('Permisos')
                    ->schema([
                        Forms\Components\Select::make('id_entidad')
                            ->relationship('entidad', 'short_nombre')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('id_nivel')
                            ->relationship('nivel', 'nivel')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Toggle::make('validar_socios')
                            ->hiddenOn('create'),
                    ])
                    ->columns()
                    ->compact(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verificado')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->alignCenter()
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable()
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('entidad.short_nombre')
                    ->formatStateUsing(fn(string $state): string => mb_strtoupper($state))
                    ->searchable()
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nivel.nivel')
                    ->searchable()
                    ->visibleFrom('sm'),
                Tables\Columns\ToggleColumn::make('activo')
                    ->disabled(function (User $record): bool {
                        $response = true;
                        if ($record->id != Auth::id() && !$record->is_root) {
                            $response = false;
                        }
                        return $response;
                    })
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('visitas')
                    ->numeric()
                    ->icon('heroicon-o-flag')
                    ->iconColor('success')
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('nivel')
                    ->relationship('nivel', 'nivel'),
                Tables\Filters\SelectFilter::make('entidad')
                    ->relationship('entidad', 'short_nombre')
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('Restablecer contraseña')
                        ->icon('heroicon-o-key')
                        ->form([
                            Forms\Components\TextInput::make('password')
                                ->label(__('Password'))
                                ->password()
                                ->required()
                                ->maxLength(255)
                                ->revealable(),
                        ])
                        ->action(function (array $data, User $record): void {
                            $record->password = $data['password'];
                            $record->save();
                            Notification::make()
                                ->title('Guardado exitosamente')
                                ->success()
                                ->send();
                        })
                        ->hidden(function (User $record): bool {
                            $response = true;
                            if ($record->id != Auth::id() && !$record->is_root) {
                                $response = false;
                            }
                            return $response;
                        })
                        ->modalWidth(MaxWidth::ExtraSmall),
                    Tables\Actions\Action::make('email_verified_at')
                        ->label('Verificar Email')
                        ->icon('heroicon-o-check-circle')
                        ->hidden(function (User $record): bool {
                            $response = false;
                            if ($record->email_verified_at) {
                                $response = true;
                            }
                            return $response;
                        })
                        ->action(function (User $record): void {
                            $record->email_verified_at = now();
                            $record->save();
                            Notification::make()
                                ->title('Guardado exitosamente')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->before(function ($record) {
                            $i = 0;
                            do {
                                $repeat = Str::repeat('*', ++$i);
                                $email = $repeat . $record->email;
                                $existe = User::withTrashed()->where('email', $email)->first();
                            } while ($existe);
                            $record->update(['email' => $email]);
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $records) {
                            foreach ($records as $record) {
                                $i = 0;
                                do {
                                    $repeat = Str::repeat('*', ++$i);
                                    $email = $repeat . $record->email;
                                    $existe = User::withTrashed()->where('email', $email)->first();
                                } while ($existe);
                                $record->update(['email' => $email]);
                            }
                        }),
                ]),
            ])
            ->checkIfRecordIsSelectableUsing(
                fn(User $record): bool => $record->id != Auth::id() && !$record->is_root
            );
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
