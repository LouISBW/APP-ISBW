<?php

namespace App\Filament\Resources\SecretariatDirectionResource\Pages;

use App\Filament\Resources\SecretariatDirectionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSecretariatDirections extends ListRecords
{
    protected static string $resource = SecretariatDirectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
