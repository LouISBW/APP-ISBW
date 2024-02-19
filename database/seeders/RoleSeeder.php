<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $Permission = new Role();
        $Permission->name = 'Administrateur';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Assistante de direction';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Adjointe à la Direction générale';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Chef de département';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Chef de service';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif 0-3';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif Infocom';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif 3-12';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif RH';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif Formation';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif BFI';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif SAPH';
        $Permission->save();

        $Permission = new Role();
        $Permission->name = 'Employé Administratif SAFA';
        $Permission->save();
    }
}
