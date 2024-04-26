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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_ID');
            $table->unsignedBigInteger('community_ID');
            $table->timestamps();

            $table->foreign('user_ID')->references('us_ID')->on('users')->onDelete('cascade');
            $table->foreign('community_ID')->references('community_ID')->on('communities')->onDelete('cascade');

            // Ensure that each user can only like a post once
            $table->unique(['user_ID', 'community_ID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
