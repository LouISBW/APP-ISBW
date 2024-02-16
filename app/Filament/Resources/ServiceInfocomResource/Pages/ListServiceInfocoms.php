<?php

namespace App\Filament\Resources\ServiceInfocomResource\Pages;

use App\Filament\Resources\ServiceInfocomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceInfocoms extends ListRecords
{
    protected static string $resource = ServiceInfocomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
