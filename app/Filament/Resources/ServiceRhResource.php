<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceRhResource\Pages;
use App\Filament\Resources\ServiceRhResource\RelationManagers;
use App\Models\Dlt;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;


class ServiceRhResource extends Resource
{
    protected static ?string $model = Dlt::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Validation DLT';

    protected static ?string $modelLabel = 'Validation DLT';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir RH');
    }
    protected static ?string $navigationGroup = 'Service Pôle RH';

    public static function getNavigationBadge(): ?string {

        return static::getModel()::where('statut_id', '=','6')->count();
    }
    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('statut_id', '=','6')->count() < 0
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

                    ]),
                Section::make('Détails DLT')
                    ->columns(2)
                    ->schema([

                        TextInput::make('month')
                            ->label('Mois concerné')
                            ->type('month'),
                        TextInput::make('nbr_dlt')
                            ->required()
                            ->label('Nombre de trajet sur le mois')
                            ->numeric()
                            ->maxValue(23)
                            ->minValue(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {

        $query = Dlt::where('statut_id', 6);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('month')
                    ->label('Mois')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
                TextColumn::make('user.services.department.name')
                    ->label('Département')
                    ->sortable(),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au Pôle RH' => 'success',
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                ExportAction::make('Télécharger')
                    ->label('Télécharger')
                    ->exports([
                        // Pass a string
                        ExcelExport::make()->fromTable()->withFilename(date('ymd').'-DLT'),
                    ]),
                Action::make('Archiver')
                    ->action(fn () => Dlt::where('statut_id', 6)->update(['statut_id' => 10]))
                    ->requiresConfirmation(),
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
            'index' => Pages\ListServiceRhs::route('/'),
            'create' => Pages\CreateServiceRh::route('/create'),
            'edit' => Pages\EditServiceRh::route('/{record}/edit'),
        ];
    }
}
