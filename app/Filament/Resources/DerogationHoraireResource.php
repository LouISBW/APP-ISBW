<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DerogationHoraireResource\Pages;
use App\Filament\Resources\DerogationHoraireResource\RelationManagers;
use App\Models\DerogationHoraire;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class DerogationHoraireResource extends Resource
{
    protected static ?string $model = DerogationHoraire::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Mes demandes';
    protected static ?string $navigationLabel = 'Dérogation horaire';
    protected static ?string $modelLabel = 'Dérogation horaire';

    public static function getNavigationBadge(): ?string
    {
        return 'NEW';
    }


    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Section::make('Information utilisateur')
                    ->columns(4)
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Utilisateur')
                            ->default($user->name)
                            ->visibleOn('create')
                            ->disabled()
                            ->columnSpan(1)
                            ->dehydrated(false)
                            ->required(),
                        Hidden::make('user_id')
                            ->default(Auth::id()),
                        Hidden::make('statut_id')
                            ->default(12),
                        Textarea::make('motif_refus')
                            ->columnSpan(4)
                            ->disabled()
                            ->label('Motif du refus')
                            ->hiddenOn('create'),
                    ]),

                Section::make('Changement horaire')
                    ->description('Veuillez remplir au minimum un jour')
                    ->schema([

                        TextInput::make('date_derogation')
                            ->type('week')
                            ->required(),
                        Fieldset::make('horaire de travail de référence')
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
                        Fieldset::make('proposition d\'horaire modifié')
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
            'index' => Pages\ListDerogationHoraires::route('/'),
            'create' => Pages\CreateDerogationHoraire::route('/create'),
            'edit' => Pages\EditDerogationHoraire::route('/{record}/edit'),
        ];
    }
}
