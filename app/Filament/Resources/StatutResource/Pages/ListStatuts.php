<?php

namespace App\Filament\Resources\StatutResource\Pages;

use App\Filament\Resources\StatutResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuts extends ListRecords
{
    protected static string $resource = StatutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
