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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['g_ID']);
        });

        // Drop the g_ID column
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('g_ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // If you want to re-add the g_ID column, define it here
            // For example:
            // $table->unsignedBigInteger('g_ID')->nullable();
        });
    }
};
