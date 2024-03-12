<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstitutionResource\Pages;
use App\Models\Institution;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InstitutionResource extends Resource
{
    protected static ?string $model = Institution::class;

    protected static ?string $modelLabel = 'Institution';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $activeNavigationIcon = 'heroicon-s-building-office';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Paramètres';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Institution');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Information sur l'institution")
                    ->columns(4)
                    ->schema([
                        TextInput::make('denomination')
                            ->maxLength(100)
                            ->label('Dénomination')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('numBCE')
                            ->label('Numéro BCE')
                            ->maxLength(30)
                            ->columnStart(3)
                            ->columnSpan(2)
                            ->required(),
                    ]),
                Section::make('Adresse')
                    ->columns(4)
                    ->schema([
                        TextInput::make('rue')
                            ->maxLength(255)
                            ->label('Rue')
                            ->columnStart(1)
                            ->columnSpan(3)
                            ->required(),
                        TextInput::make('numero')
                            ->label('Numéro')
                            ->maxLength(30)
                            ->numeric()
                            ->columnStart(4)
                            ->columnSpan(1)
                            ->required(),
                        TextInput::make('cp')
                            ->label('Code Postal')
                            ->maxLength(6)
                            ->numeric()
                            ->columnStart(1)
                            ->columnSpan(1)
                            ->required(),
                        TextInput::make('localite')
                            ->label('Localité')
                            ->maxLength(50)
                            ->columnStart(2)
                            ->columnSpan(3)
                            ->required(),
                    ]),
                Section::make('Information service')
                    ->columns(4)
                    ->schema([
                        TextInput::make('service')
                            ->maxLength(255)
                            ->label('Service')
                            ->default('prive')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('agrement')
                            ->label("Numéro d'agrément")
                            ->maxLength(10)
                            ->numeric()
                            ->columnStart(3)
                            ->columnSpan(1)
                            ->required(),
                        Select::make('revisionGeneralBaremes')
                            ->required()
                            ->columnStart(1)
                            ->label('Révision Generale Barèmes')
                            ->options([
                                'Oui' => 'Oui',
                                'Non' => 'Non',
                            ]),
                        Select::make('amenagementFinCarriere')
                            ->required()
                            ->label('Aménagement Fin de carriere')
                            ->options([
                                'Oui' => 'Oui',
                                'Non' => 'Non',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('denomination')
                    ->label('Dénomination'),
                TextColumn::make('rue')
                    ->label('Rue'),
                TextColumn::make('cp')
                    ->label('Code Postal'),
                TextColumn::make('localite')
                    ->label('Ville'),
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
            'index' => Pages\ListInstitutions::route('/'),
            'create' => Pages\CreateInstitution::route('/create'),
            'edit' => Pages\EditInstitution::route('/{record}/edit'),
        ];
    }
}
