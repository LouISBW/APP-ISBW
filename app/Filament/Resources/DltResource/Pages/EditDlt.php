<?php

namespace App\Filament\Resources\DltResource\Pages;

use App\Filament\Resources\DltResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDlt extends EditRecord
{
    protected static string $resource = DltResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
