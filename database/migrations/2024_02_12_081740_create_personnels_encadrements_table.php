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
        Schema::create('personnels_encadrements', function (Blueprint $table) {
            $table->id();
            $table->string('civilite')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('dateEntree')->nullable();
            $table->string('dateSortie')->nullable();
            $table->string('fonction')->nullable();
            $table->string('regimeHebdo')->nullable();
            $table->string('regimeHoraireTp')->nullable();
            $table->string('modeFincancement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels_encadrements');
    }
};
