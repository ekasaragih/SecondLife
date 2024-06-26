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
       Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_ID');
            $table->unsignedBigInteger('us_ID');
            $table->string('us_name'); // Tambahkan kolom us_name
            $table->text('comment_desc');
            $table->timestamps();

            $table->foreign('us_ID')->references('us_ID')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
