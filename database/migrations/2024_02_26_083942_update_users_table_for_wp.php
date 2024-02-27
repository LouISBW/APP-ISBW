<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
        DB::table('wp_users')
            ->orderBy('id')
            ->chunk(100, function ($wp_users) {
                foreach ($wp_users as $wp_user) {

                    // add new user (if doesn't exist)
                    User::firstOrCreate(
                        [
                            'email' => $wp_user->user_email,
                        ],
                        [
                            'name' => $wp_user->display_name,
                            'password' => Hash::make('123456')
                        ]
                    );
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }
};
