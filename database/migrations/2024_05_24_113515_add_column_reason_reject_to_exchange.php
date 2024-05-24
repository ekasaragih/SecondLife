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
            $table->timestamp('confirmed_at')->nullable()->after('exchanged_at');
            $table->string('reason_reject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchange', function (Blueprint $table) {
            $table->dropColumn('confirmed_at');
            $table->dropColumn('reason_reject');
        });
    }
};
