<?php

namespace App\Filament\Resources\TypeNoteDeFraisResource\Pages;

use App\Filament\Resources\TypeNoteDeFraisResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTypeNoteDeFrais extends CreateRecord
{
    protected static string $resource = TypeNoteDeFraisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
