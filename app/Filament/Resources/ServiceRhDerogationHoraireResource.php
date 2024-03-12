<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceRhDerogationHoraireResource\Pages;
use App\Models\DerogationHoraire;
use App\Models\Dlt;
use App\Models\Statut;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceRhDerogationHoraireResource extends Resource
{
    protected static ?string $model = DerogationHoraire::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Validation Dérogation Horaire';

    protected static ?string $modelLabel = 'Validation Dérogation Horaire';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir RH');
    }

    protected static ?string $navigationGroup = 'Pôle RH';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information utilisateur')
                    ->columns(4)
                    ->schema([
                        Select::make('user_id')
                            ->label('Demandeur')
                            ->disabled()
                            ->relationship('user', 'name')
                            ->required(),
                        Select::make('statut_id')
                            ->label('Statut')
                            ->options(Statut::whereIn('id', [6, 10])->pluck('name', 'id'))
                            ->required(),
                        Textarea::make('motif_refus')
                            ->columnSpan(4)
                            ->label('Motif du refus')
                            ->hiddenOn('create'),
                    ]),
                Section::make('Changement horaire')
                    ->description('Veuillez remplir au minimum un jour')
                    ->schema([

                        TextInput::make('date_derogation')
                            ->type('week')
                            ->required(),
                        Fieldset::make('Horaire de travail de référence')
                            ->columns(5)
                            ->schema([
                                TimePicker::make('de_lundi')
                                    ->prefix('de')
                                    ->label('Lundi')
                                    ->seconds(false)
                                    ->columnSpan(1),
                                TimePicker::make('de_mardi')
                                    ->prefix('de')
                                    ->label('Mardi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('de_mercredi')
                                    ->prefix('de')
                                    ->label('Mercredi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('de_jeudi')
                                    ->prefix('de')
                                    ->label('Jeudi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('de_vendredi')
                                    ->prefix('de')
                                    ->label('Vendredi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('fin_lundi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),
                                TimePicker::make('fin_mardi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('fin_mercredi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('fin_jeudi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('fin_vendredi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),
                            ]),
                        Fieldset::make('Proposition d\'horaire modifié')
                            ->columns(5)
                            ->schema([
                                TimePicker::make('p_de_lundi')
                                    ->prefix('de')
                                    ->label('Lundi')
                                    ->seconds(false)
                                    ->columnSpan(1),
                                TimePicker::make('p_de_mardi')
                                    ->prefix('de')
                                    ->label('Mardi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_de_mercredi')
                                    ->prefix('de')
                                    ->label('Mercredi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_de_jeudi')
                                    ->prefix('de')
                                    ->label('Jeudi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_de_vendredi')
                                    ->prefix('de')
                                    ->label('Vendredi')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_fin_lundi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),
                                TimePicker::make('p_fin_mardi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_fin_mercredi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_fin_jeudi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),

                                TimePicker::make('p_fin_vendredi')
                                    ->prefix('à')
                                    ->label('')
                                    ->seconds(false)
                                    ->columnSpan(1),
                            ]),
                        Textarea::make('motif_demande')
                            ->required()
                            ->label('Motif du changement')
                            ->autosize()
                            ->columnSpan(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = DerogationHoraire::where('statut_id', 6);
        return $table
            ->query($query)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('date_derogation')
                    ->label('Semaine')
                    ->date()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au Pôle RH' => 'success',
                        'Validation en attente' => 'warning',
                        'Approuvé' => 'success',
                        'Refusé' => 'danger',
                        'Archivé' => 'info',
                    }),
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
            'index' => Pages\ListServiceRhDerogationHoraires::route('/'),
            'create' => Pages\CreateServiceRhDerogationHoraire::route('/create'),
            'edit' => Pages\EditServiceRhDerogationHoraire::route('/{record}/edit'),
        ];
    }
}
