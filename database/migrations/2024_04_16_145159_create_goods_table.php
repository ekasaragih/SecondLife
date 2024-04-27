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
        Schema::create('goods', function (Blueprint $table) {
            $table->id('g_ID');
            $table->unsignedBigInteger('us_ID');
            $table->string('g_name');
            $table->string('g_desc');
            $table->string('g_type')->nullable();
            $table->integer('g_original_price')->nullable();
            $table->integer('g_age')->nullable();
            $table->string('g_category')->nullable();
            $table->timestamps();

            $table->foreign('us_ID')->references('us_ID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
