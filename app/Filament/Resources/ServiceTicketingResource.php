<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceTicketingResource\Pages;
use App\Models\Statut;
use App\Models\Ticketing;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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

    public static function getNavigationBadge(): ?string
    {

        return static::getModel()::where('statut_id', '=', '7')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('statut_id', '=', '7')->count() > 5
            ? 'warning'
            : 'success';
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
                            ->relationship('user', 'name')
                            ->required(),
                        Select::make('statut_id')
                            ->label('Statut')
                            ->options(Statut::whereIn('id', [1, 7, 9, 11])->pluck('name', 'id'))
                            ->required(),
                        DatePicker::make('date_creation')
                            ->required()
                            ->date()
                            ->readonly()
                            ->hiddenOn('edit')
                            ->default(now())
                            ->timezone('Europe/Brussels')
                            ->columnSpan(1)
                            ->label('Date'),
                        Select::make('assigned_to')
                            ->label('Assigné à')
                            ->options([
                                'Pierre Lucas' => 'Pierre Lucas',
                                'Sébastien Farese' => 'Sébastien Farese',
                                'Louis VanRenterghem' => 'Louis VanRenterghem',
                            ])
                            ->required(),
                        Toggle::make('is_onsite')
                            ->required()
                            ->inline(false)
                            ->label('En Télétravail')
                            ->onColor('danger'),
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
                            ->relationship('type_ticketing', 'name'),
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
                            ->placeholder('Veuillez décrire avec précision votre problème afin que nos équipes puissent vous aider au plus vite')
                            ->required(),
                        FileUpload::make('attachment')
                            ->label('Pièce jointe')
                            ->columnStart(1)
                            ->columnSpan(4),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->defaultSort('date_creation', 'desc')
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
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au service Infocom' => 'warning',
                        'En Cours' => 'success',
                        'Assigné' => 'info',
                        'Cloturé' => 'info',
                    }),
                TextColumn::make('assigned_to')
                    ->label('Assigné à')
                    ->color('info')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('is_new')
                    ->label('Nouveaux Tickets')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('statut_id', 7)),
                Filter::make('in_progress')
                    ->label('En cours')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('statut_id', 1)),
                Filter::make('is_finished')
                    ->label('Cloturé')
                    ->toggle()
                    ->query(fn (Builder $query): Builder => $query->where('statut_id', 9)),
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
            'index' => Pages\ListServiceTicketings::route('/'),
            'create' => Pages\CreateServiceTicketing::route('/create'),
            'edit' => Pages\EditServiceTicketing::route('/{record}/edit'),
        ];
    }
}
