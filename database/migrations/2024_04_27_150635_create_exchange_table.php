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
        Schema::create('exchange', function (Blueprint $table) {
            $table->id('ex_ID');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('other_user_id');
            $table->unsignedBigInteger('user_goods_id');
            $table->unsignedBigInteger('other_user_goods_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('user_id')->references('us_ID')->on('users');
            $table->foreign('other_user_id')->references('us_ID')->on('users');
            $table->foreign('user_goods_id')->references('g_ID')->on('goods');
            $table->foreign('other_user_goods_id')->references('g_ID')->on('goods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange');
    }
};
