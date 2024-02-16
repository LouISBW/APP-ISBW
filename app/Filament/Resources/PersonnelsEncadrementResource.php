<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonnelsEncadrementResource\Pages;
use App\Filament\Resources\PersonnelsEncadrementResource\RelationManagers;
use App\Models\PersonnelsEncadrement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonnelsEncadrementResource extends Resource
{
    protected static ?string $model = PersonnelsEncadrement::class;

    protected static ?string $modelLabel = 'Personnels Encadrement';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $activeNavigationIcon = 'heroicon-s-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'SAFA';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir SAFA paramètres');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListPersonnelsEncadrements::route('/'),
            'create' => Pages\CreatePersonnelsEncadrement::route('/create'),
            'edit' => Pages\EditPersonnelsEncadrement::route('/{record}/edit'),
        ];
    }
}
