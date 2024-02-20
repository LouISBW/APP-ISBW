<?php

namespace App\Filament\Resources\ApprobationNoteDeFraisResource\Pages;

use App\Filament\Resources\ApprobationNoteDeFraisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApprobationNoteDeFrais extends ListRecords
{
    protected static string $resource = ApprobationNoteDeFraisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
