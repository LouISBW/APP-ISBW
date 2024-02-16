<?php

namespace App\Filament\Resources\MaterialBookingResource\Pages;

use App\Filament\Resources\MaterialBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialBooking extends EditRecord
{
    protected static string $resource = MaterialBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
