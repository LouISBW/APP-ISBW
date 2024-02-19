<?php

namespace App\Filament\Resources\DltResource\Pages;

use App\Filament\Resources\DltResource;
use App\Models\Dlt;
use App\Models\Ticketing;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateDlt extends CreateRecord
{
    protected static string $resource = DltResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $userId = Auth::id();
        $month = $data['month'] ?? '';

        $data['verifkey'] = $userId . '-' . $month;

        return $data;
    }
}
