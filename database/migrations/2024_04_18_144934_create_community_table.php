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
            $table->unsignedBigInteger('us_ID');
            $table->string('community_title');
            $table->text('community_desc');
            $table->timestamps();

            $table->foreign('us_ID')->references('us_ID')->on('users');
            
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_ID');
            $table->unsignedBigInteger('us_ID');
            $table->foreignId('community_ID');
            $table->text('feedback_desc');
            $table->timestamps();

            $table->foreign('us_ID')->references('us_ID')->on('users');
            $table->foreign('community_ID')->references('community_ID')->on('communities');
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
