<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Permission = new Permission();
        $Permission->name = 'Voir Paramètres';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir BFI';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir SAFA';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Formation';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Infocom';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir DG';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir RH';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Puéricultrices';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Rapports';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir SAFA paramètres';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir paramètres salles';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Paramètres';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Institution';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir Formulaires';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Voir secretariat direction';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Supprimer demandes';
        $Permission->save();

    }
}
