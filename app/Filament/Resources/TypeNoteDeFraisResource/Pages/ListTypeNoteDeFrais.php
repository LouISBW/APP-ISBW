<?php

namespace App\Filament\Resources\TypeNoteDeFraisResource\Pages;

use App\Filament\Resources\TypeNoteDeFraisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTypeNoteDeFrais extends ListRecords
{
    protected static string $resource = TypeNoteDeFraisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
