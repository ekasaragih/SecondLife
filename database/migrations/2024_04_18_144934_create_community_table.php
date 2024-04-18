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
        Schema::create('communities', function (Blueprint $table) {
            $table->id('community_ID');
            $table->foreignId('us_ID');
            $table->string('community_title');
            $table->text('community_desc');
            $table->timestamps();
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_ID');
            $table->foreignId('us_ID');
            $table->foreignId('community_ID');
            $table->text('feedback_desc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community');
        Schema::dropIfExists('feedback');
    }
};
