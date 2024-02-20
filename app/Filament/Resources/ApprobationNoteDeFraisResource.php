<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApprobationNoteDeFraisResource\Pages;
use App\Filament\Resources\ApprobationNoteDeFraisResource\RelationManagers;
use App\Models\ApprobationNoteDeFrais;
use App\Models\NoteDeFrais;
use App\Models\Service;
use App\Models\Statut;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprobationNoteDeFraisResource extends Resource
{
    protected static ?string $model = NoteDeFrais::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Approbations';
    protected static ?string $navigationLabel = 'Approuver Note de Frais';
    protected static ?string $modelLabel = 'Approuver Note de Frais';

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
                            ->relationship('user','name')
                            -> required(),
                        Select::make('statut_id')
                            ->label('Statut')
                            ->options(Statut::whereIn('id', [3, 4])->pluck('name', 'id'))
                            -> required(),
                        Textarea::make('motif_refus')
                            ->columnStart(1)
                            ->columnSpan(4)
                            ->label('Motif du refus'),

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
                            ->disabled()
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
        $user = Auth::user();
        $serviceIds = $user->services()->pluck('services.id');

        $userIds = DB::table('service_user')->whereIn('service_id', $serviceIds)->pluck('user_id');


        $query = NoteDeFrais::whereIn('user_id', $userIds)->where('statut_id', 12);


        return $table
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
            'index' => Pages\ListApprobationNoteDeFrais::route('/'),
            'create' => Pages\CreateApprobationNoteDeFrais::route('/create'),
            'edit' => Pages\EditApprobationNoteDeFrais::route('/{record}/edit'),
        ];
    }
}
