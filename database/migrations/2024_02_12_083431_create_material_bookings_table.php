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
        Schema::create('material_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->date('date_depart')->nullable();
            $table->boolean('rollup1')->nullable()->default(0);
            $table->boolean('rollup2')->nullable()->default(0);
            $table->boolean('rollup3')->nullable()->default(0);
            $table->boolean('beach1')->nullable()->default(0);
            $table->boolean('beach2')->nullable()->default(0);
            $table->boolean('beach3')->nullable()->default(0);
            $table->boolean('projecteur')->nullable()->default(0);
            $table->boolean('hp')->nullable()->default(0);
            $table->boolean('piedhp')->nullable()->default(0);
            $table->boolean('multiprise')->nullable()->default(0);
            $table->boolean('portable')->nullable()->default(0);
            $table->date('date_retour')->nullable();
            $table->text('etat_retour')->nullable();
            $table->text('autre')->nullable();
            $table->text('remarques')->nullable();
            $table->foreignId('statut_id')->nullable()->default(7)->constrained('statuts');
            $table->text('motif_refus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_bookings');
    }
};
