<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeNoteDeFraisResource\Pages;
use App\Filament\Resources\TypeNoteDeFraisResource\RelationManagers;
use App\Models\TypeNf;
use App\Models\TypeNoteDeFrais;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypeNoteDeFraisResource extends Resource
{
    protected static ?string $model = TypeNf::class;

    protected static ?string $modelLabel = 'Paramètres Notes de frais';

    protected static ?string $navigationGroup = 'Pôle Budget et Finances ';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Paramètres BFI');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nom')
                    ->unique(ignoreRecord : true)
                    ->minLength(2)
                    ->maxLength(255),
                TextInput::make('codecompta')
                    ->label('Code Comptable')
                    ->unique(ignoreRecord : true)
                    ->minLength(2)
                    ->numeric()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->label('Nom'),
                TextColumn::make('codecompta')
                    ->label('Code Comptable')
                    ->sortable()
                    ->numeric(),
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
            'index' => Pages\ListTypeNoteDeFrais::route('/'),
            'create' => Pages\CreateTypeNoteDeFrais::route('/create'),
            'edit' => Pages\EditTypeNoteDeFrais::route('/{record}/edit'),
        ];
    }
}
