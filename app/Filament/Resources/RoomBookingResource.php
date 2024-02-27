<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomBookingResource\Pages;
use App\Filament\Resources\RoomBookingResource\RelationManagers;
use App\Models\MaterialBooking;
use App\Models\RoomBooking;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class RoomBookingResource extends Resource
{
    protected static ?string $model = RoomBooking::class;

    protected static ?string $navigationGroup = 'Mes demandes';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Réservation de salles';

    protected static ?string $modelLabel = 'Réservation de salles';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function getNavigationBadge(): ?string
    {
        return 'NEW';
    }
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Formulaires');
    }


    public static function form(Form $form): Form
    {
        $user = Auth::user();

        return $form
            ->schema([
                Section::make('Information générale')
                    ->columns(4)
                    ->schema([
                        TextInput::make('user.name')
                            ->label('Utilisateur')
                            ->visibleOn('create')
                            ->default($user->name)
                            ->disabled()
                            ->columnSpan(1)
                            ->dehydrated(false)
                            ->required(),
                        Textarea::make('motif_refus')
                            ->columnSpan(4)
                            ->disabled()
                            ->label('Motif du refus')
                            ->hiddenOn('create'),
                        Hidden::make('user_id')
                            ->default(Auth::id()),
                        Hidden::make('statut_id')
                            ->default(8),
                        DatePicker::make('date')
                            ->required()
                            ->timezone('Europe/Brussels')
                            ->columnStart(1)
                            ->columnSpan(1)
                            ->label('Date'),
                        TimePicker::make('heure_debut')
                            ->required()
                            ->seconds(false)
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Heure de début'),
                        TimePicker::make('heure_fin')
                            ->required()
                            ->seconds(false)
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Heure de fin'),
                        TextInput::make('Nbre_participant')
                            ->label('Nombre de participants')
                            ->required()
                            ->numeric()
                            ->columnSpan(1),

                    ]),
                Section::make('Salle demandée')
                    ->columns(4)
                    ->schema([
                        Toggle::make('salle1')
                            ->label('Salle du Cerf')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('salle4')
                            ->label('Petite Salle')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('salle2')
                            ->label('Salle du Lac')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('salle3')
                            ->label('Salle Mazerin')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                    ]),
                Section::make('Demande de boissons/nourriture')
                    ->columns(4)
                    ->schema([
                        Toggle::make('drink1')
                            ->label('Eau Plate')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('drink2')
                            ->label('Eau Gazeuse')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('drink3')
                            ->label('Café')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('food1')
                            ->columnStart(1)
                            ->label('Sandwich')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('food2')
                            ->label('Wraps')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                    ]),
                Section::make('Demande de matériel')
                    ->columns(4)
                    ->schema([
                        Toggle::make('projecteur')
                            ->label('Projecteur (InBw)')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('filp')
                            ->label('Flipchart (InBw)')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                    ]),
                Section::make('Divers')
                    ->columns(4)
                    ->schema([
                        Textarea::make('remarques')
                            ->label('Remarques')
                            ->placeholder("Veuillez noter si du matériel autre que celui de l'InBW est nécessaire")
                            ->columnSpan(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $query = RoomBooking::where('user_id', $user->id);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('heure_debut')
                    ->label('Heude de début')
                    ->time()
                    ->sortable(),
                TextColumn::make('heure_fin')
                    ->label('Heure de fin')
                    ->time()
                    ->sortable(),
                TextColumn::make('Nbre_participant')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Nombre de participants')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('salle1')
                    ->boolean()
                    ->label('Salle du Cerf'),
                IconColumn::make('salle2')
                    ->boolean()
                    ->label('Salle du Lac')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('salle3')
                    ->boolean()
                    ->label('Salle Mazerin')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('salle4')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Petite Salle'),
                IconColumn::make('drink1')
                    ->boolean()
                    ->label('Eau Plate'),
                IconColumn::make('drink2')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Eau Gazeuse'),
                IconColumn::make('drink3')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Café'),
                IconColumn::make('eat1')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Sandwich'),
                IconColumn::make('eat2')
                    ->boolean()
                    ->label('Wraps'),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au secrétariat DG' => 'warning',
                        'Approuvé' => 'success',
                        'Refusé' => 'danger',
                    })
                    ->sortable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                ]),

            ])
            ->bulkActions([


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
            'index' => Pages\ListRoomBookings::route('/'),
            'create' => Pages\CreateRoomBooking::route('/create'),
            'edit' => Pages\EditRoomBooking::route('/{record}/edit'),
        ];
    }
}
