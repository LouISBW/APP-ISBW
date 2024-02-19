<?php

namespace App\Filament\Resources\TypeTicketingResource\Pages;

use App\Filament\Resources\TypeTicketingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTypeTicketing extends EditRecord
{
    protected static string $resource = TypeTicketingResource::class;

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
