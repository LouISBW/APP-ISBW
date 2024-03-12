<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personnels_encadrements', function (Blueprint $table) {
            $table->string('nbKm1sem')->nullable();
            $table->string('nbKm2sem')->nullable();
            $table->string('nbKm1trim')->nullable();
            $table->string('nbKm2trim')->nullable();
            $table->string('nbKm3trim')->nullable();
            $table->string('nbKm4trim')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personnels_encadrements', function (Blueprint $table) {
            //
        });
    }
};
