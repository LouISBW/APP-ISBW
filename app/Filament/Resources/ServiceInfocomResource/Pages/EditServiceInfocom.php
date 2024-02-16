<?php

namespace App\Filament\Resources\ServiceInfocomResource\Pages;

use App\Filament\Resources\ServiceInfocomResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceInfocom extends EditRecord
{
    protected static string $resource = ServiceInfocomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
