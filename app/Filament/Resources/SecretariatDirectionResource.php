<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SecretariatDirectionResource\Pages;
use App\Filament\Resources\SecretariatDirectionResource\RelationManagers;
use App\Models\RoomBooking;
use App\Models\SecretariatDirection;
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
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\select;

class SecretariatDirectionResource extends Resource
{
    protected static ?string $model = RoomBooking::class;

    protected static ?string $navigationGroup = 'Secrétariat Direction';

    protected static ?string $navigationLabel = 'Demande de salles';

    protected static ?string $modelLabel = 'Demande de salles';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir secretariat direction');
    }
    public static function getNavigationBadge(): ?string {

        return static::getModel()::where('statut_id', '=','8')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('statut_id', '=','8')->count() > 4
            ? 'warning'
            : 'success';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information générale')
                    ->columns(4)
                    ->schema([
                        Select::make('user_id')
                            ->label('Demandeur')
                            ->disabled()
                            ->relationship('user','name')
                            -> required(),
                        Select::make('statut_id')
                            ->label('Statut')
                            ->relationship('statut','name')
                            -> required(),
                        DatePicker::make('date')
                            ->required()
                            ->timezone('Europe/Brussels')
                            ->columnStart(1)
                            ->columnSpan(1)
                            ->label('Date'),
                        TimePicker::make('heure_debut')
                            ->required()
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Heure de début'),
                        TimePicker::make('heure_fin')
                            ->required()
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Heure de fin'),
                        TextInput::make('Nbre_participant')
                            ->label('Nombre de participant')
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
                        Toggle::make('salle2')
                            ->label('Salle du Lac')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('salle3')
                            ->label('Salle Mazerin')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('salle4')
                            ->label('Petite Salle')
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
                            ->label('Projecteur')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                        Toggle::make('filp')
                            ->label('Flipchart')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-user'),
                    ]),
                Section::make('Divers')
                    ->columns(4)
                    ->schema([
                        Textarea::make('remarques')
                            ->label('Remarques')
                            ->columnSpan(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = RoomBooking::where('statut_id', 8);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
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
                    ->label('Nombre de participants')
                    ->numeric()
                    ->sortable(),

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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSecretariatDirections::route('/'),
            'create' => Pages\CreateSecretariatDirection::route('/create'),
            'edit' => Pages\EditSecretariatDirection::route('/{record}/edit'),
        ];
    }
}
