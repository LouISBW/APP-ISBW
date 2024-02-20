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
        Schema::create('note_de_frais', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->integer('montant')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('statut_id')->nullable()->default(7)->constrained('statuts');
            $table->foreignId('type_nfs_id')->nullable()->constrained('type_nfs');
            $table->string('justificatif')->nullable();
            $table->text('motif_refus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_de_frais');
    }
};
