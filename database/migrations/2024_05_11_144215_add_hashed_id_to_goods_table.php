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
        Schema::table('goods', function (Blueprint $table) {
            $table->string('hashed_id')->nullable()->after('g_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->dropColumn('hashed_id');
        });
    }
};
