<?php

namespace App\Filament\Resources\DltResource\Pages;

use App\Filament\Resources\DltResource;
use App\Models\Dlt;
use App\Models\Ticketing;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class CreateDlt extends CreateRecord
{
    protected static string $resource = DltResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function beforeSave(): void
    {
        $verifkey = $this->form->getState()['verifkey'] ?? null;
        dd($verifkey);
        if ($verifkey) {
            $existingRecord = Dlt::where('verifkey', $verifkey)->first();

            if ($existingRecord) {
                throw ValidationException::withMessages([
                    'verifkey' => ['Un enregistrement avec cette clé de vérification existe déjà.'],
                ]);
            }
        }
    }

}
