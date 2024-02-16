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
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->date('date')->nullable();
            $table->time('heure_debut')->nullable();
            $table->time('heure_fin')->nullable();
            $table->integer('Nbre_participant')->nullable()->default(1);
            $table->boolean('salle1')->nullable()->default(0);
            $table->boolean('salle2')->nullable()->default(0);
            $table->boolean('salle3')->nullable()->default(0);
            $table->boolean('salle4')->nullable()->default(0);
            $table->boolean('drink1')->nullable()->default(0);
            $table->boolean('drink2')->nullable()->default(0);
            $table->boolean('drink3')->nullable()->default(0);
            $table->text('autre')->nullable();
            $table->text('remarques')->nullable();
            $table->text('motif_refus')->nullable();
            $table->foreignId('statut_id')->nullable()->default('8')->constrained('statuts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_bookings');
    }
};
