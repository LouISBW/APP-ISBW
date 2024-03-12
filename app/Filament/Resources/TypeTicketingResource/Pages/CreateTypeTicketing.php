<?php

namespace App\Filament\Resources\TypeTicketingResource\Pages;

use App\Filament\Resources\TypeTicketingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeTicketing extends CreateRecord
{
    protected static string $resource = TypeTicketingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
