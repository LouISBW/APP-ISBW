<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceRhResource\Pages;
use App\Filament\Resources\ServiceRhResource\RelationManagers;
use App\Models\Dlt;
use App\Models\ServiceRh;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceRhResource extends Resource
{
    protected static ?string $model = Dlt::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Validation DLT';

    protected static ?string $modelLabel = 'Validation DLT';

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = User::all();
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
            'index' => Pages\ListServiceRhs::route('/'),
            'create' => Pages\CreateServiceRh::route('/create'),
            'edit' => Pages\EditServiceRh::route('/{record}/edit'),
        ];
    }
}
