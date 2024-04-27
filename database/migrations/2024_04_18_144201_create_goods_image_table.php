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
        Schema::create('goods_image', function (Blueprint $table) {
            $table->id('img_ID');
            $table->string('img_url');
            $table->unsignedBigInteger('g_ID');
            $table->unsignedBigInteger('us_ID');
            $table->timestamps();

            $table->foreign('us_ID')->references('us_ID')->on('users');
            $table->foreign('g_ID')->references('g_ID')->on('goods');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_image');
    }
};
