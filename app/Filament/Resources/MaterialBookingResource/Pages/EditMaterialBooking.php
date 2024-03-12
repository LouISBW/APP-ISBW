<?php

namespace App\Filament\Resources\MaterialBookingResource\Pages;

use App\Filament\Resources\MaterialBookingResource;
use Filament\Resources\Pages\EditRecord;

class EditMaterialBooking extends EditRecord
{
    protected static string $resource = MaterialBookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
