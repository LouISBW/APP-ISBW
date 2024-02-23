<?php

namespace App\Filament\Resources\DerogationHoraireResource\Pages;

use App\Filament\Resources\DerogationHoraireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDerogationHoraires extends ListRecords
{
    protected static string $resource = DerogationHoraireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
