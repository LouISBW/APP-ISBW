<?php

namespace App\Filament\Resources\NoteDeFraisResource\Pages;

use App\Filament\Resources\NoteDeFraisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNoteDeFrais extends EditRecord
{
    protected static string $resource = NoteDeFraisResource::class;

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
