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
        Schema::create('derogation_horaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('date_derogation')->nullable();
            $table->time('de_lundi')->nullable();
            $table->time('fin_lundi')->nullable();
            $table->time('de_mardi')->nullable();
            $table->time('fin_mardi')->nullable();
            $table->time('de_mercredi')->nullable();
            $table->time('fin_mercredi')->nullable();
            $table->time('de_jeudi')->nullable();
            $table->time('fin_jeudi')->nullable();
            $table->time('de_vendredi')->nullable();
            $table->time('fin_vendredi')->nullable();
            $table->time('p_de_lundi')->nullable();
            $table->time('p_fin_lundi')->nullable();
            $table->time('p_de_mardi')->nullable();
            $table->time('p_fin_mardi')->nullable();
            $table->time('p_de_mercredi')->nullable();
            $table->time('p_fin_mercredi')->nullable();
            $table->time('p_de_jeudi')->nullable();
            $table->time('p_fin_jeudi')->nullable();
            $table->time('p_de_vendredi')->nullable();
            $table->time('p_fin_vendredi')->nullable();
            $table->text('motif_refus')->nullable();
            $table->foreignId('statut_id')->nullable()->default(12)->constrained('statuts');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derogation_horaires');
    }
};
