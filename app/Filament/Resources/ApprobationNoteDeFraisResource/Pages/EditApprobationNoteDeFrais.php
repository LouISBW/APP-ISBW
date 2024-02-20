<?php

namespace App\Filament\Resources\ApprobationNoteDeFraisResource\Pages;

use App\Filament\Resources\ApprobationNoteDeFraisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApprobationNoteDeFrais extends EditRecord
{
    protected static string $resource = ApprobationNoteDeFraisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
