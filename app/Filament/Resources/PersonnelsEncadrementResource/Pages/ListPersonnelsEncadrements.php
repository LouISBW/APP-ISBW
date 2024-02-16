<?php

namespace App\Filament\Resources\PersonnelsEncadrementResource\Pages;

use App\Filament\Resources\PersonnelsEncadrementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnelsEncadrements extends ListRecords
{
    protected static string $resource = PersonnelsEncadrementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
