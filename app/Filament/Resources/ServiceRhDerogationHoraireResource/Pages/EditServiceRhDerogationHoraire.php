<?php

namespace App\Filament\Resources\ServiceRhDerogationHoraireResource\Pages;

use App\Filament\Resources\ServiceRhDerogationHoraireResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceRhDerogationHoraire extends EditRecord
{
    protected static string $resource = ServiceRhDerogationHoraireResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
