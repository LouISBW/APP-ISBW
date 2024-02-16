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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('numBCE')->nullable();
            $table->string('denomination')->nullable();
            $table->string('rue')->nullable();
            $table->string('numero')->nullable();
            $table->string('boite')->nullable();
            $table->string('cp')->nullable();
            $table->string('localite')->nullable();
            $table->string('service')->nullable()->default('prive');
            $table->string('agrement')->nullable();
            $table->string('revisionGeneralBaremes')->nullable();
            $table->string('amenagementFinCarriere')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
