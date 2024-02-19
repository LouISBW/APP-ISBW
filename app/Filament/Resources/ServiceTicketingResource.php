<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceTicketingResource\Pages;
use App\Filament\Resources\ServiceTicketingResource\RelationManagers;
use App\Models\ServiceTicketing;
use App\Models\Ticketing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceTicketingResource extends Resource
{
    protected static ?string $model = Ticketing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Ticketing';

    protected static ?string $modelLabel = 'Ticketing';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Ticket');
    }
    protected static ?string $navigationGroup = 'Service Infocom';

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = Ticketing::where('statut_id', 7);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('date_creation')
                    ->label('Date de création')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Demandeur')
                    ->sortable(),
                TextColumn::make('type_demande')
                    ->label('Type')
                    ->sortable(),
                TextColumn::make('subject')
                    ->label('Sujet')
                    ->sortable(),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au service Infocom' => 'warning',
                        'En cours' => 'success',
                    })
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
            'index' => Pages\ListServiceTicketings::route('/'),
            'create' => Pages\CreateServiceTicketing::route('/create'),
            'edit' => Pages\EditServiceTicketing::route('/{record}/edit'),
        ];
    }
}
