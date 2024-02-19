<?php

namespace App\Filament\Resources\TypeTicketingResource\Pages;

use App\Filament\Resources\TypeTicketingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeTicketings extends ListRecords
{
    protected static string $resource = TypeTicketingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
