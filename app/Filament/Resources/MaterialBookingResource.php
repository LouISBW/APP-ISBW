<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialBookingResource\Pages;
use App\Filament\Resources\MaterialBookingResource\RelationManagers;
use App\Models\MaterialBooking;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class MaterialBookingResource extends Resource
{
    protected static ?string $model = MaterialBooking::class;

    protected static ?string $navigationGroup = 'Mes demandes';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Réservation matériel';

    protected static ?string $modelLabel = 'Réservation Matériel';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
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
                        Textarea::make('motif_refus')
                            ->columnSpan(4)
                            ->disabled()
                            ->label('Motif du refus')
                            ->hiddenOn('create'),
                        Hidden::make('user_id')
                            ->default(Auth::id()),
                        Hidden::make('statut_id')
                            ->default(7),
                        DatePicker::make('date_depart')
                            ->required()
                            ->timezone('Europe/Brussels')
                            ->columnStart(1)
                            ->columnSpan(1)
                            ->label('Date de départ'),
                        DatePicker::make('date_retour')
                            ->required()
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Date de retour'),
                        TimePicker::make('heure_depart')
                            ->required()
                            ->seconds(false)
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Heure de départ du matériel'),
                        Radio::make('installation')
                            ->label('Installation à faire au Mazerin')
                            ->required()
                            ->inline()
                            ->inlineLabel(false)
                            ->boolean(),
                    ]),
                Section::make('Matériel demandé')
                    ->columns(4)
                    ->schema([
                        Toggle::make('rollup1')
                            ->label('Rollup By Laurence')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('rollup2')
                            ->label('Rollup By Catherine')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('rollup3')
                            ->label('Rollup By Astrid')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('hp')
                            ->label('Haut Parleur')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('beach1')
                            ->label('Beach Flag 1')
                            ->columnStart(1)
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('beach2')
                            ->label('Beach Flag 2')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('beach3')
                            ->label('Beach Flag 3')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('piedhp')
                            ->label('Pied Haut Parleur')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('projecteur')
                            ->label('Projecteur')
                            ->columnStart(1)
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('portable')
                            ->label('Pc Portable')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('multiprise')
                            ->label('Multiprise')
                            ->onIcon('heroicon-m-bolt')
                            ->offIcon('heroicon-m-user'),
                    ]),
                Section::make('Divers')
                    ->columns(4)
                    ->schema([
                        Textarea::make('remarques')
                            ->label('Remarques')
                            ->placeholder("Veuillez préciser ici si besoin de matériel spécifique ou si la réservation est pour un autre service")
                            ->columnSpan(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $query = MaterialBooking::where('user_id', $user->id);

        return $table
            ->query($query)
            ->columns([
                TextColumn::make('date_depart')
                    ->label('Date de départ')
                    ->date()
                    ->sortable(),
                IconColumn::make('rollup1')
                    ->boolean()
                    ->label('By Laurence'),
                IconColumn::make('rollup2')
                    ->boolean()
                    ->label('By Catherine')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('rollup3')
                    ->boolean()
                    ->label('By Astrid')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('beach1')
                    ->boolean()
                    ->label('Beach Flag 1'),
                IconColumn::make('beach2')
                    ->boolean()
                    ->label('Beach Flag 2')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('beach3')
                    ->boolean()
                    ->label('Beach Flag 3')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('projecteur')
                    ->boolean()
                    ->label('Projecteur'),
                IconColumn::make('portable')
                    ->boolean()
                    ->label('Pc Portable'),
                IconColumn::make('multiprise')
                    ->boolean()
                    ->label('Multiprise')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('hp')
                    ->boolean()
                    ->label('Haut Parleur'),
                IconColumn::make('piedhp')
                    ->boolean()
                    ->label('Pied Haut Parleur')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au service Infocom' => 'warning',
                        'Approuvé' => 'success',
                        'Refusé' => 'danger',
                    })
                    ->sortable(),
                TextColumn::make('motif_refus')
                    ->label('Motif du refus')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListMaterialBookings::route('/'),
            'create' => Pages\CreateMaterialBooking::route('/create'),
            'edit' => Pages\EditMaterialBooking::route('/{record}/edit'),
        ];
    }


}
