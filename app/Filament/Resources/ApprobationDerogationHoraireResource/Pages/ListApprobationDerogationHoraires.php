<?php

namespace App\Filament\Resources\ApprobationDerogationHoraireResource\Pages;

use App\Filament\Resources\ApprobationDerogationHoraireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApprobationDerogationHoraires extends ListRecords
{
    protected static string $resource = ApprobationDerogationHoraireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
