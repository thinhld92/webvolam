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
        Schema::table('Account_Info', function (Blueprint $table) {
            $table->string('remember_token', 100)->nullable();
            $table->string('avatar', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Account_Info', function (Blueprint $table) {
            $table->dropColumn('remember_token');
            $table->dropColumn('avatar');
        });
    }
};
