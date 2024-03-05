<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DltResource\Pages;
use App\Filament\Resources\DltResource\RelationManagers;
use App\Models\Dlt;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class DltResource extends Resource
{
    protected static ?string $model = Dlt::class;

    protected static ?string $navigationGroup = 'Mes demandes';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Encodage DLT';
    protected static ?string $modelLabel = 'Encodage DLT';
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function getNavigationBadge(): ?string
    {
        return 'NEW';
    }
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('Voir Phase 2');
    }


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
                            ->default(6),
                        TextInput::make('verifkey')
                            ->label("Numéro d'enregistrement")
                            ->disabled()
                            ->required()
                            ->unique()
                            ->validationMessages([
                               'unique' => "Vous avez déjà rentré des DLT pour cette période",
                            ]),
                    ]),
                Section::make('Détails DLT')
                    ->columns(2)
                    ->schema([

                        TextInput::make('month')
                            ->label('Mois concerné')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Forms\Set $set){
                                  if ($operation !== 'create')  {
                                      return;
                                  }
                                  $id = Auth::user()->id;
                                  $month = Carbon::now()->format('Y/m');
                                  $setup = $id.'-'.$month;
                                  $set('verifkey', $setup);

                            })
                            ->type('month'),
                        TextInput::make('nbr_dlt')
                            ->required()
                            ->label('Nombre de trajet sur le mois')
                            ->numeric()
                            ->maxValue(23)
                            ->minValue(1),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {

        $user = Auth::user();
        $query = Dlt::where('user_id', $user->id);
        return $table
            ->query($query)
            ->columns([
                TextColumn::make('month')
                    ->label('Mois')
                    ->sortable(),
                TextColumn::make('nbr_dlt')
                    ->label('Nombre de DLT'),
                TextColumn::make('statut.name')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Transmis au Pôle RH' => 'success',
                        'Archivé' => 'info',
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([

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
            'index' => Pages\ListDlts::route('/'),
            'create' => Pages\CreateDlt::route('/create'),
            'edit' => Pages\EditDlt::route('/{record}/edit'),
        ];
    }
}
