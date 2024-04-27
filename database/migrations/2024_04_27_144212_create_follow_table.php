<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('follow', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->references('us_ID')->on('users')->onDelete('cascade');
            $table->foreignId('followed_id')->references('us_ID')->on('users')->onDelete('cascade');
            $table->timestamps();
        
            // Ensure that each user can only like a post once
            $table->unique(['follower_id', 'followed_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('follows');
    }
};
