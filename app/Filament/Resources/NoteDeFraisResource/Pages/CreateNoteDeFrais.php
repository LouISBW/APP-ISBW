<?php

namespace App\Filament\Resources\NoteDeFraisResource\Pages;

use App\Filament\Resources\NoteDeFraisResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNoteDeFrais extends CreateRecord
{
    protected static string $resource = NoteDeFraisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
