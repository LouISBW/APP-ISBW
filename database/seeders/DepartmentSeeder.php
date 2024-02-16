<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = new Department();
        $department->name = 'Transversaux';
        $department->save();

        $department = new Department();
        $department->name = 'Departement 0-3';
        $department->save();

        $department = new Department();
        $department->name = 'Departement 3-12';
        $department->save();

        $department = new Department();
        $department->name = 'Département Santé et Famille';
        $department->save();

        $department = new Department();
        $department->name = 'Direction Générale';
        $department->save();
    }
}
