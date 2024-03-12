<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceBFIResource\Pages;
use App\Models\NoteDeFrais;
use App\Models\Statut;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ServiceBFIResource extends Resource
{
    protected static ?string $model = NoteDeFrais::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Pôle Budget et Finances ';

    protected static ?string $navigationLabel = 'Validation Note de Frais';

    protected static ?string $modelLabel = 'Validation Note de Frais';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir BFI');
    }

    public static function getNavigationBadge(): ?string
    {

        return static::getModel()::where('statut_id', '=', '4')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('statut_id', '=', '4')->count() < 0
            ? 'warning'
            : 'success';
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
                            ->options(Statut::whereIn('id', [2, 3, 4])->pluck('name', 'id'))
                            ->required(),

                    ]),
                Section::make('Détail Note de Frais')
                    ->columns(4)
                    ->schema([
                        TextInput::make('month')
                            ->label('Mois concerné')
                            ->required()
                            ->disabled()
                            ->type('month'),
                        Select::make('type_nfs_id')
                            ->required()
                            ->label('Type de note de frais')
                            ->relationship('type_nfs', 'name')
                            ->columnSpan(2),
                        TextInput::make('montant')
                            ->label('Montant')
                            ->disabled()
                            ->numeric()
                            ->prefixIcon('heroicon-o-currency-euro')
                            ->required(),
                        FileUpload::make('justificatif')
                            ->columnSpan(4)
                            ->preserveFilenames(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = NoteDeFrais::where('statut_id', 4);

        return $table
            ->defaultSort('created_at', 'desc')
            ->query($query)
            ->columns([
                TextColumn::make('month')
                    ->label('Mois')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
                TextColumn::make('montant')
                    ->label('Montant')
                    ->money('EUR')
                    ->sortable(),
                TextColumn::make('type_nfs.name')
                    ->label('Tyde de NF')
                    ->sortable(),
                TextColumn::make('type_nfs.codecompta')
                    ->label('Code Comptable')
                    ->sortable(),
                ImageColumn::make('justificatif')
                    ->label('Justificatif')
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
            ->headerActions([
                ExportAction::make('Télécharger')
                    ->label('Télécharger')
                    ->exports([
                        // Pass a string
                        ExcelExport::make()->fromTable()->withFilename(date('ymd').'-NF'),
                    ]),
                Action::make('Archiver')
                    ->action(fn () => NoteDeFrais::where('statut_id', 4)->update(['statut_id' => 2]))
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
            'index' => Pages\ListServiceBFIS::route('/'),
            'create' => Pages\CreateServiceBFI::route('/create'),
            'edit' => Pages\EditServiceBFI::route('/{record}/edit'),
        ];
    }
}
