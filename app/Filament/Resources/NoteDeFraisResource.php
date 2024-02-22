<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteDeFraisResource\Pages;
use App\Filament\Resources\NoteDeFraisResource\RelationManagers;
use App\Models\MaterialBooking;
use App\Models\NoteDeFrais;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class NoteDeFraisResource extends Resource
{
    protected static ?string $model = NoteDeFrais::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Mes demandes';
    protected static ?string $navigationLabel = 'Dépot Note de Frais';
    protected static ?string $modelLabel = 'Dépot Note de Frais';

    public static function getNavigationBadge(): ?string
    {
        return 'NEW';
    }
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }



    public static function form(Form $form): Form
    {
        $user = Auth::user();

        return $form
            ->schema([
                Section::make('Information Utilisateur')
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
                            ->default(12),
                    ]),
                Section::make('Détail Note de Frais')
                    ->columns(4)
                    ->schema([
                        TextInput::make('month')
                            ->label('Mois concerné')
                            ->required()
                            ->type('month'),
                        Select::make('type_nfs_id')
                            ->required()
                            ->label('Type de note de frais')
                            ->relationship('type_nfs', 'name')
                            ->columnSpan(2),
                        TextInput::make('montant')
                            ->label('Montant')
                            ->numeric()
                            ->prefixIcon('heroicon-o-currency-euro')
                            ->required(),
                        FileUpload::make('justificatif')
                            ->columnSpan(4)
                            ->multiple()
                            ->preserveFilenames(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $query = NoteDeFrais::where('user_id', $user->id);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('month')
                    ->label('Mois')
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
            ->headerActions([
                Tables\Actions\CreateAction::make()
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
            'index' => Pages\ListNoteDeFrais::route('/'),
            'create' => Pages\CreateNoteDeFrais::route('/create'),
            'edit' => Pages\EditNoteDeFrais::route('/{record}/edit'),
        ];
    }
}
