<?php

namespace App\Filament\Resources\TypeNoteDeFraisResource\Pages;

use App\Filament\Resources\TypeNoteDeFraisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeNoteDeFrais extends EditRecord
{
    protected static string $resource = TypeNoteDeFraisResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
