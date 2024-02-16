<?php

namespace App\Filament\Resources\SecretariatDirectionResource\Pages;

use App\Filament\Resources\SecretariatDirectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSecretariatDirection extends EditRecord
{
    protected static string $resource = SecretariatDirectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
