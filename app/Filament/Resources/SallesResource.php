<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SallesResource\Pages;
use App\Filament\Resources\SallesResource\RelationManagers;
use App\Models\Salle;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SallesResource extends Resource
{
    protected static ?string $model = Salle::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $activeNavigationIcon = 'heroicon-s-briefcase';

    protected static ?string $modelLabel = 'Salles de Réunion';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationGroup = 'Paramètres';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir paramètres salles');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information Salles')
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->label('Nom')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->placeholder('Entrez le nom de la salle')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
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
            'index' => Pages\ListSalles::route('/'),
            'create' => Pages\CreateSalles::route('/create'),
            'edit' => Pages\EditSalles::route('/{record}/edit'),
        ];
    }
}
