<?php

namespace App\Filament\Resources\TicketingResource\Pages;

use App\Filament\Resources\TicketingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicketing extends CreateRecord
{
    protected static string $resource = TicketingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
