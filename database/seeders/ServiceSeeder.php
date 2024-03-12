<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $service = new Service();
        $service->name = 'Infocom';
        $service->save();

        $service = new Service();
        $service->name = 'SAFA';
        $service->save();

        $service = new Service();
        $service->name = 'SAPH';
        $service->save();

        $service = new Service();
        $service->name = 'SAE';
        $service->save();

        $service = new Service();
        $service->name = 'Expertise';
        $service->save();

        $service = new Service();
        $service->name = 'Puericultrice relais';
        $service->save();

        $service = new Service();
        $service->name = 'SIPP';
        $service->save();

        $service = new Service();
        $service->name = 'DPD';
        $service->save();

        $service = new Service();
        $service->name = 'Coordinatrices';
        $service->save();

        $service = new Service();
        $service->name = 'Equipe support';
        $service->save();

        $service = new Service();
        $service->name = 'Pôle BFI';
        $service->save();

        $service = new Service();
        $service->name = 'Pôle RH';
        $service->save();

        $service = new Service();
        $service->name = 'Service Formation';
        $service->save();
    }
}
