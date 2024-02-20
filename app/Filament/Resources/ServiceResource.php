<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationGroup = 'Paramètres';

    protected static ?string $modelLabel = 'Services';

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $navigationIcon = 'heroicon-s-clipboard';
    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard';


    protected static ?int $navigationSort = 5;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Paramètres');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information Service')
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->label('Nom')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->placeholder('Entrez le nom du service')
                            ->required(),
                        Select::make('department')
                            ->preload()
                            ->label('Département')
                            ->columnSpan(2)
                            ->relationship('department', 'name'),
                        Select::make('approver_id')
                            ->preload()
                            ->columnStart(1)
                            ->required()
                            ->label('Responsable Approbation')
                            ->relationship('approver', 'name'),
                        Select::make('second_approver_id')
                            ->preload()
                            ->label('Suppléant')
                            ->relationship('second_approver', 'name'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                TextColumn::make('department.name')
                    ->label('Département')
                    ->searchable(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
