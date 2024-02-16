<?php

namespace App\Filament\Resources\MaterialBookingResource\Pages;

use App\Filament\Resources\MaterialBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialBookings extends ListRecords
{
    protected static string $resource = MaterialBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
