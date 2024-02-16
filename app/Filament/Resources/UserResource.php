<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\BelongsToManyMultiSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Utilisateurs';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Paramètres';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Paramètres');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information Utilisateur')
                    ->columns(4)
                    ->schema([
                        TextInput::make('name')
                            ->maxLength(100)
                            ->label('Nom complet')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->placeholder('Entrez votre nom complet')
                            ->required(),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->maxLength(255)
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->email()
                            ->placeholder('Entrez votre E-mail')
                            ->required(),
                        TextInput::make('password')
                            ->label('Mot de passe')
                            ->maxLength(50)
                            ->columnSpan(2)
                            ->password()
                            ->placeholder('Entrez votre mot de passe')
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create'),
                        BelongsToManyMultiSelect::make('services')
                            ->preload()
                            ->label('Services')
                            ->columnSpan(3)
                            ->relationship('services', 'name'),
                        Select::make('roles')
                            ->preload()
                            ->multiple()
                            ->label('roles')
                            ->columnSpan(3)
                            ->relationship('roles', 'name'),
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
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                TextColumn::make('services.name')
                    ->label('Service')
                    ->searchable(),
                TextColumn::make('services.department.name')
                    ->label('Département')
                    ->formatStateUsing(function ($state, $record) {
                        // Récupère les départements uniques des services de l'utilisateur
                        $departments = $record->services->map(function ($service) {
                            return $service->department->name;
                        })->unique();

                        return $departments->join(', ');
                    })
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
