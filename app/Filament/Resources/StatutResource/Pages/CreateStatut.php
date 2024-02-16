<?php

namespace App\Filament\Resources\StatutResource\Pages;

use App\Filament\Resources\StatutResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateStatut extends CreateRecord
{
    protected static string $resource = StatutResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
