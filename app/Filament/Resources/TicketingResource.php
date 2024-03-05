<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketingResource\Pages;
use App\Filament\Resources\TicketingResource\RelationManagers;
use App\Models\Ticketing;
use Filament\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TicketingResource extends Resource
{
    protected static ?string $model = Ticketing::class;

    protected static ?string $navigationGroup = 'Mes demandes';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Support Technique';

    protected static ?string $modelLabel = 'Support Technique';
    public static function getNavigationBadge(): ?string
    {
        return 'NEW';
    }
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Formulaires');
    }

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        $user = Auth::user();
        return $form
            ->schema([
                Section::make('Information utilisateur')
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
                        Hidden::make('user_id')
                            ->default(Auth::id()),
                        Hidden::make('statut_id')
                            ->default(7),
                        DatePicker::make('date_creation')
                            ->required()
                            ->date()
                            ->readonly()
                            ->default(now())
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Date'),
                        Toggle::make('is_onsite')
                            ->required()
                            ->inline(false)
                            ->label('En Télétravail')
                            ->onColor('danger')
                    ]),
                Section::make('Information Ticket')
                    ->columns(4)
                    ->schema([
                        Select::make('type_demande')
                            ->label('Type de demande')
                            ->columnStart(1)
                            ->columnSpan(2)
                            ->required()
                            ->options([
                                'Question' => 'Question',
                                'Problème' => 'Problème',
                                'Demande de changement site/intranet' => 'Demande de changement site/intranet',
                                'Autre' => 'Autre',
                            ]),
                        Select::make('type_ticketing_id')
                            ->label('Sévérité')
                            ->required()
                            ->relationship('type_ticketing','name'),
                        TextInput::make('subject')
                            ->label('Sujet de la demande')
                            ->visibleOn('create')
                            ->columnStart(1)
                            ->columnSpan(3)
                            ->required(),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpan(4)
                            ->rows(10)
                            ->columnStart(1)
                            ->placeholder("Veuillez décrire avec précision votre problème afin que nos équipes puissent vous aider au plus vite")
                            ->required(),
                        FileUpload::make('attachment')
                            ->label('Pièce jointe')
                            ->columnStart(1)
                            ->columnSpan(4)



                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $query = Ticketing::where('user_id', $user->id);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('date_creation')
                    ->label('Date de création')
                    ->date('d/m/Y')
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
                        'Assigné' => 'primary'

                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ]),

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
            'index' => Pages\ListTicketings::route('/'),
            'create' => Pages\CreateTicketing::route('/create'),
            'edit' => Pages\EditTicketing::route('/{record}/edit'),
        ];
    }
}
