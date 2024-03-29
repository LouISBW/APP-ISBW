<?php

namespace App\Filament\Resources\SallesResource\Pages;

use App\Filament\Resources\SallesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSalles extends CreateRecord
{
    protected static string $resource = SallesResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
