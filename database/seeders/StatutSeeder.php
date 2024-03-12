<?php

namespace Database\Seeders;

use App\Models\Statut;
use Illuminate\Database\Seeder;

class StatutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statut = new Statut();
        $statut->name = 'En Cours';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Approuvé';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Refusé';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Transmis au Pôle BFI';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Transmis au service Formation';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Transmis au Pôle RH';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Transmis au service Infocom';
        $statut->save();

        $statut = new Statut();
        $statut->name = 'Transmis au secrétariat DG';
        $statut->save();
    }
}
