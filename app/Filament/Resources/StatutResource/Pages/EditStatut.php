<?php

namespace App\Filament\Resources\StatutResource\Pages;

use App\Filament\Resources\StatutResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatut extends EditRecord
{
    protected static string $resource = StatutResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
