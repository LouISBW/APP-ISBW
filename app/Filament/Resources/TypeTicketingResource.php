<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeTicketingResource\Pages;
use App\Models\TypeTicketing;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TypeTicketingResource extends Resource
{
    protected static ?string $model = TypeTicketing::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Sévérité Tickets';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationGroup = 'Paramètres';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Paramètres');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->label('Nom')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->required(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeTicketings::route('/'),
            'create' => Pages\CreateTypeTicketing::route('/create'),
            'edit' => Pages\EditTypeTicketing::route('/{record}/edit'),
        ];
    }
}
