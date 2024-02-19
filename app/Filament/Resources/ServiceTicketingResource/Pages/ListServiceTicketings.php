<?php

namespace App\Filament\Resources\ServiceTicketingResource\Pages;

use App\Filament\Resources\ServiceTicketingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceTicketings extends ListRecords
{
    protected static string $resource = ServiceTicketingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
