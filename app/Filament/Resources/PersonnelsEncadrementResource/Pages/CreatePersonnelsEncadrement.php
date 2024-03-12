<?php

namespace App\Filament\Resources\PersonnelsEncadrementResource\Pages;

use App\Filament\Resources\PersonnelsEncadrementResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePersonnelsEncadrement extends CreateRecord
{
    protected static string $resource = PersonnelsEncadrementResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
