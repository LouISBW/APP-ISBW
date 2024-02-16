<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceInfocomResource\Pages;
use App\Filament\Resources\ServiceInfocomResource\RelationManagers;
use App\Models\MaterialBooking;
use App\Models\ServiceInfocom;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                //
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
            'index' => Pages\ListServiceInfocoms::route('/'),
            'create' => Pages\CreateServiceInfocom::route('/create'),
            'edit' => Pages\EditServiceInfocom::route('/{record}/edit'),
        ];
    }
}
