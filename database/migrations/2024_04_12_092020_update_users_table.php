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
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing 'us_age' column
            $table->dropColumn('us_age');

            // Add the new 'us_DOB' column
            $table->date('us_DOB')->nullable()->after('us_avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the 'us_DOB' column
            $table->dropColumn('us_DOB');

            // Recreate the 'us_age' column
            $table->integer('us_age')->nullable()->after('us_username');
        });
    }
};
