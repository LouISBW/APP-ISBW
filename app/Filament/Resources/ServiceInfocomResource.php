<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceInfocomResource\Pages;
use App\Filament\Resources\ServiceInfocomResource\RelationManagers;
use App\Models\MaterialBooking;
use App\Models\ServiceInfocom;
use App\Models\Statut;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ServiceInfocomResource extends Resource
{
    protected static ?string $model = MaterialBooking::class;

    protected static ?string $navigationGroup = 'Service Infocom';

    protected static ?string $navigationLabel = 'Demande de matériel';

    protected static ?string $modelLabel = 'Demande de matériel';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Infocom');
    }
    public static function getNavigationBadge(): ?string {

        return static::getModel()::where('statut_id', '=','7')->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('statut_id', '=','7')->count() > 5
            ? 'warning'
            : 'success';
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
                            ->relationship('user','name')
                            -> required(),
                        Select::make('statut_id')
                            ->label('Statut')
                            ->options(Statut::whereIn('id', [2, 3])->pluck('name', 'id'))
                            -> required(),
                        Textarea::make('motif_refus')
                            ->label('Motif du refus')
                            ->columnStart(1)
                            ->columnSpan(4),
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
                            ->columnSpan(4),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = MaterialBooking::where('statut_id', 7);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_depart')
                    ->label('Date de départ')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_retour')
                    ->label('Date de départ')
                    ->date()
                    ->sortable(),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au service Infocom' => 'warning',
                        'Approuvé' => 'success',
                        'Refusé' => 'danger',
                    })
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
            'index' => Pages\ListServiceInfocoms::route('/'),
            'create' => Pages\CreateServiceInfocom::route('/create'),
            'edit' => Pages\EditServiceInfocom::route('/{record}/edit'),
        ];
    }
}
