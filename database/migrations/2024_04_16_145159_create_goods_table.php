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
            $table->foreignId('us_ID')->constrained('users');
            $table->string('g_name');
            $table->string('g_desc');
            $table->string('g_type')->nullable();
            $table->integer('g_original_price')->nullable();
            $table->integer('g_age')->nullable();
            $table->string('g_category')->nullable();
            $table->timestamps();
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
