<?php

namespace App\Filament\Resources\ServiceRhResource\Pages;

use App\Filament\Resources\ServiceRhResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceRhs extends ListRecords
{
    protected static string $resource = ServiceRhResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
