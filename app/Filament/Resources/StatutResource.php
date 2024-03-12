<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatutResource\Pages;
use App\Models\Statut;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatutResource extends Resource
{
    protected static ?string $model = Statut::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static ?string $activeNavigationIcon = 'heroicon-s-paper-clip';

    protected static ?string $modelLabel = 'Statut';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'Paramètres';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Paramètres');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information Statut')
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->label('Nom')
                            ->columnStart(1)
                            ->columnSpan(2)
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
            'index' => Pages\ListStatuts::route('/'),
            'create' => Pages\CreateStatut::route('/create'),
            'edit' => Pages\EditStatut::route('/{record}/edit'),
        ];
    }
}
