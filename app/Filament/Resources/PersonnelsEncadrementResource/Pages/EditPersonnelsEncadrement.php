<?php

namespace App\Filament\Resources\PersonnelsEncadrementResource\Pages;

use App\Filament\Resources\PersonnelsEncadrementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPersonnelsEncadrement extends EditRecord
{
    protected static string $resource = PersonnelsEncadrementResource::class;

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
