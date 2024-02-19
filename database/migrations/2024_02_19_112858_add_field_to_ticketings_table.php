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
        Schema::table('ticketings', function (Blueprint $table) {
            $table->foreignId('type_ticketing_id')->default(1)->nullable()->constrained('type_ticketings');
            $table->string('assigned_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticketings', function (Blueprint $table) {
            //
        });
    }
};
