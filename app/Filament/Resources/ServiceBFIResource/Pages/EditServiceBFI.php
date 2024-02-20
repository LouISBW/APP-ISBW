<?php

namespace App\Filament\Resources\ServiceBFIResource\Pages;

use App\Filament\Resources\ServiceBFIResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceBFI extends EditRecord
{
    protected static string $resource = ServiceBFIResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
