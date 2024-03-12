<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers\ServicesRelationManager;
use App\Models\Department;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $modelLabel = 'Départements';

    protected static ?string $navigationLabel = 'Départements';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard';

    protected static ?string $navigationGroup = 'Paramètres';

    protected static ?int $navigationSort = 4;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasRole('SuperAdmin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information Département')
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->label('Nom')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->placeholder('Entrez le nom du département')
                            ->required(),
                        Select::make('approver_id')
                            ->preload()
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
            ServicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
