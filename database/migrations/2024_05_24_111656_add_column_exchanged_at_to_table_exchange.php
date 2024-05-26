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
        Schema::table('exchange', function (Blueprint $table) {
            $table->timestamp('meet_up_at')->nullable()->after('status');
            $table->timestamp('exchanged_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchange', function (Blueprint $table) {
            $table->dropColumn('meet_up_at');
            $table->dropColumn('exchanged_at');
        });
    }
};
