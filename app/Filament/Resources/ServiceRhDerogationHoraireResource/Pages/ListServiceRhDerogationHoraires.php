<?php

namespace App\Filament\Resources\ServiceRhDerogationHoraireResource\Pages;

use App\Filament\Resources\ServiceRhDerogationHoraireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceRhDerogationHoraires extends ListRecords
{
    protected static string $resource = ServiceRhDerogationHoraireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
