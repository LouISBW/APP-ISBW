<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApprobationDerogationHoraireResource\Pages;
use App\Models\DerogationHoraire;
use App\Models\Statut;
use Carbon\Carbon;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprobationDerogationHoraireResource extends Resource
{
    protected static ?string $model = DerogationHoraire::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Approbations';

    protected static ?string $navigationLabel = 'Approuver Dérogation Horaire';

    protected static ?string $modelLabel = 'Approuver Dérogation Horaire';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Approbation');
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

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
                            ->options(Statut::whereIn('id', [12, 3, 6])->pluck('name', 'id'))
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
        $user = Auth::user();
        $serviceIds = $user->services()->pluck('services.id');

        $userIds = DB::table('service_user')->whereIn('service_id', $serviceIds)->pluck('user_id');

        $query = DerogationHoraire::whereIn('user_id', $userIds)->where('statut_id', 12);

        return $table
            ->defaultSort('created_at', 'desc')
            ->query($query)
            ->columns([
                TextColumn::make('date_derogation')
                    ->label('Semaine')

                    ->sortable()
                    ->formatStateUsing(function ($state, $record) {

                        $value = $state;
                        if (! $value) {
                            return 'N/A';
                        }
                        $year = substr($value, 0, 4);
                        $week = substr($value, 6);
                        $date = Carbon::now()->setISODate($year, $week)->startOfWeek();

                        return $date->format('d M Y').' - '.$date->endOfWeek()->format('d M Y');
                    }),
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Validation en attente' => 'warning',
                        'Approuvé' => 'success',
                        'Refusé' => 'danger',
                        'Transmis au Pôle BFI' => 'info',
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
            'index' => Pages\ListApprobationDerogationHoraires::route('/'),
            'create' => Pages\CreateApprobationDerogationHoraire::route('/create'),
            'edit' => Pages\EditApprobationDerogationHoraire::route('/{record}/edit'),
        ];
    }
}
