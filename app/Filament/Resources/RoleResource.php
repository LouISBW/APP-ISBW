<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Rôles';

    protected static ?string $navigationGroup = 'Paramètres';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('SuperAdmin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Rôle')
                    ->unique(ignoreRecord : true)
                    ->minLength(2)
                    ->maxLength(255),
                Select::make('permissions')
                    ->label('Permissions')
                    ->multiple()
                    ->preload()
                    ->relationship('permissions', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table

            ->columns([
                TextColumn::make('name')
                    ->label('Rôle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
