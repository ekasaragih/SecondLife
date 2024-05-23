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
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('goods_owner_ID');
            $table->unsignedBigInteger('my_goods');
            $table->unsignedBigInteger('barter_with');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('requested_by')->references('us_ID')->on('users');
            $table->foreign('goods_owner_ID')->references('us_ID')->on('users');
            $table->foreign('my_goods')->references('g_ID')->on('goods');
            $table->foreign('barter_with')->references('g_ID')->on('goods');
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
