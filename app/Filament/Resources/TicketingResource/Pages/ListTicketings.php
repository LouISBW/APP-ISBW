<?php

namespace App\Filament\Resources\TicketingResource\Pages;

use App\Filament\Resources\TicketingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTicketings extends ListRecords
{
    protected static string $resource = TicketingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
