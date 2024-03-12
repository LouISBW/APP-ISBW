<?php

namespace App\Filament\Resources\ServiceRhResource\Pages;

use App\Filament\Resources\ServiceRhResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceRh extends CreateRecord
{
    protected static string $resource = ServiceRhResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
