<?php

namespace Database\Seeders;

use App\Models\TypeTicketing;
use Illuminate\Database\Seeder;

class TypeTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new TypeTicketing();
        $type->name = 'Faible';
        $type->save();

        $type = new TypeTicketing();
        $type->name = 'Normale';
        $type->save();

        $type = new TypeTicketing();
        $type->name = 'Elevé';
        $type->save();

        $type = new TypeTicketing();
        $type->name = 'Critique/Bloquant';
        $type->save();
    }
}
