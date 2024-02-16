<?php

namespace App\Filament\Resources\MaterialBookingResource\Pages;

use App\Filament\Resources\MaterialBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMaterialBooking extends CreateRecord
{
    protected static string $resource = MaterialBookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
