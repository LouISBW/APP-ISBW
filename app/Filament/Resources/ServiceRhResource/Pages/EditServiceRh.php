<?php

namespace App\Filament\Resources\ServiceRhResource\Pages;

use App\Filament\Resources\ServiceRhResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceRh extends EditRecord
{
    protected static string $resource = ServiceRhResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
