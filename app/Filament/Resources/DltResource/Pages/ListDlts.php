<?php

namespace App\Filament\Resources\DltResource\Pages;

use App\Filament\Resources\DltResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDlts extends ListRecords
{
    protected static string $resource = DltResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
