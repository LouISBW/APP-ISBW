<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonnelsEncadrementResource\Pages;
use App\Models\PersonnelsEncadrement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                Section::make('Informations')
                    ->columns(4)
                    ->schema([
                        Select::make('civilite')
                            ->disabledOn('edit')
                            ->label('Civilité')
                            ->options([
                                'monsieur' => 'Monsieur',
                                'madame' => 'Madame',
                            ]),
                        TextInput::make('nom')
                            ->disabledOn('edit')
                            ->maxLength(100)
                            ->label('Nom')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->required(),
                        TextInput::make('prenom')
                            ->disabledOn('edit')
                            ->maxLength(100)
                            ->label('Prénom')
                            ->columnSpan(2)
                            ->required(),
                        DatePicker::make('dateNaissance')
                            ->disabledOn('edit')
                            ->label('Date de naissance')
                            ->required(),
                        Fieldset::make('Informations générale')
                            ->columns(4)
                            ->schema([
                                Select::make('fonction')
                                    ->label('Fonction')
                                    ->disabledOn('edit')
                                    ->options([
                                        'Aide familiale' => 'Aide familiale',
                                        'Autres' => 'Autres',
                                        'Encadrement social' => 'Encadrement social',
                                        'Personnel administratif' => 'Personnel administratif',
                                    ]),
                                DatePicker::make('dateEntree')
                                    ->label("Date d'entrée")
                                    ->format('d/m/Y')
                                    ->required(),
                                DatePicker::make('dateSortie')
                                    ->label('Date de sortie')
                                    ->format('d/m/Y'),
                            ]),
                        Fieldset::make('Informations subsides')
                            ->columns(4)
                            ->schema([
                                TextInput::make('nbKm1sem')
                                    ->label("Nombre d'heures rémunérées")
                                    ->columnStart(1)
                                    ->columnSpan(1)
                                    ->numeric(),
                                TextInput::make('nbKm1sem')
                                    ->label('Nombre Kilomètres 1er Semestre')
                                    ->columnStart(1)
                                    ->columnSpan(1)
                                    ->numeric(),
                                TextInput::make('nbKm2sem')
                                    ->label('Nombre Kilomètres 2ème Semestre')
                                    ->columnSpan(1)
                                    ->numeric(),
                                TextInput::make('nbKm1trim')
                                    ->columnStart(1)
                                    ->label('Nombre Kilomètres 1er Trimestre')
                                    ->columnSpan(1)
                                    ->numeric(),
                                TextInput::make('nbKm2trim')
                                    ->label('Nombre Kilomètres 2ème Trimestre')
                                    ->columnSpan(1)
                                    ->numeric(),
                                TextInput::make('nbKm3trim')
                                    ->label('Nombre Kilomètres 3ème Trimestre')
                                    ->columnSpan(1)
                                    ->numeric(),
                                TextInput::make('nbKm4trim')
                                    ->label('Nombre Kilomètres 4ème Trimestre')
                                    ->columnSpan(1)
                                    ->numeric(),
                            ]),
                    ]),
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
